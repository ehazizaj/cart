<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use stdClass;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('welcome');
    }

    public function store(Request $request)
    {
        $car = Car::find($request->car);
        $vars = new StdClass();
        $vars->id = $car->id;
        $vars->brand = $car->brand;
        $vars->model = $car->model;
        $vars->price = $car->price;
        $vars->quantity = 1;
        session()->push('basket', $vars);
        return response(['msg' => 'Basket added', 'status' => 'success']);

    }

    public function update_cart(Request $request)
    {
        foreach(Session::get('basket') as $product)
        {
            if ($product->id == $request->id)
            {
                $product->quantity = $request->quantity;
            }
        }
        return response([$request->quantity, $request->id, Session::get('basket')]);
    }

    public function get_cart() {
        $products = Session::get('basket');

        if ($products)
        {
            return view('cart_review')->with(['products' => $products]);
        }
        else
        {
            return redirect()->route('home')->with('error', sprintf('Cart is empty'));
        }

    }

    public function delete_cart($id)
    {
        $products = Session::get('basket');

        for(   $i=0;$i<count($products);$i++ )
        {
            if( $products[$i]->id == $id){

                unset( $products[$i] );
            }
        }
        session()->put('basket', $products);
        return redirect()->route('cart')->with('success', sprintf('Product Deleted'));
    }

    public function submit_cart()
    {
        Session::forget('basket');
        return redirect()->route('home')->with('success', sprintf('Products Purchased'));
    }


    function search(Request $request)
    {

        $ids = array();
        //check if session has value, if not initialize it as array
        //if yes, create an array with all the id that are in the session so we can remove the "Add to cart" in view
        if (session()->has('basket'))
        {
            foreach(Session::get('basket') as $product)
            {
                array_push($ids,$product->id);
            }
        }

        $output = '';
        $tags = '';
        $query = $request->get('query');
        //get data if search box is not empty
        if($query != '')
        {

            $data = Car::where('isActive', 1)
                ->where('brand', 'like', '%'.$query.'%')
                ->orWhere('model', 'like', '%'.$query.'%')
                ->orWhere('registration', 'like', '%'.$query.'%')
                ->orWhere('engine', 'like', '%'.$query.'%')
                ->orderBy('id', 'desc')
                ->get();
        }
        else
        {
            //get data if search box is empty
            $data = Car
                ::where('isActive', 1)
                ->with('tags')
                ->orderBy('id', 'desc')
                ->get();
        }


        $total_row = $data->count();

        if($total_row > 0)
        {

            foreach($data as $row)
            {
                //check each car if has tags
                $tags = $row->tags;
                if ($tags)
                {
                    foreach($tags as $t){
                        $tags .= '
                    <li><span class="label label-success">'.$t->name.'</span></li>
                     ';                }
                }
                if (in_array($row->id, $ids))
        {
            $output .= '
                    <li class="media panel panel-body stack-media-on-mobile">
                        <div class="media-body">
                               <h6 class="media-heading text-semibold">
                                     <p>'.$row->brand.' '.$row->model.'</p>
                                </h6>
                           <ul class="list-inline list-inline-separate mb-10">
                                    '.$tags.'
                            </ul>
                                <ul class="list-inline content-group">
                                    <li>Registration : <b>'.$row->registration.'</b></li>
                                            <br>
                                     <li>Engine : <b>'.$row->engine.'</b></li>
                                            <br>
                                     <li>Price : <b>'.number_format($row->price, 2).'</b></li>
                                             <br>
                                      <li>Stored : <em><b>'.date('H:i j M Y', strtotime($row->created_at)).'</b></em><br></li>
                                </ul>
                          </div>
                           <div class="media-right text-center">
                                <h3 class="no-margin text-semibold">
                                    '.number_format($row->price, 2).' $
                                </h3>
                                <button type="button"  class="btn bg-teal-400 mt-15">
                                <i class="icon-basket position-left"></i> Added to cart
                                </button>
                         </div>
                    </li>';

        }
                else
                {
                    $output .= '
                        <li class="media panel panel-body stack-media-on-mobile">
                            <div class="media-body">
                                <h6 class="media-heading text-semibold">
                                    <p>'.$row->brand.' '.$row->model.'</p>
                                </h6>
                            <ul class="list-inline list-inline-separate mb-10">
                                    '.$tags   .'
                                </ul>
                                   <ul class="list-inline content-group">
                                <li>Registration : <b>'.$row->registration.'</b></li>
                                         <br>
                                 <li>Engine : <b>'.$row->engine.'</b></li>
                                          <br>
                                <li>Price : <b>'.number_format($row->price, 2).'</b></li>
                                          <br>
                                <li>Stored : <em><b>'.date('H:i j M Y', strtotime($row->created_at)).'</b></em><br></li>
                                </ul>
                             </div>
                            <div class="media-right text-center">
                                <h3 class="no-margin text-semibold">
                                '.number_format($row->price, 2).' $
                                </h3>
                            <button type="button"  
                            onclick="addToCart('. $row->id .')" 
                             id="added'. $row->id .'" 
                             class="btn bg-teal-400 mt-15">
                             <i class="icon-cart-add position-left"></i> 
                             Add to cart
                             </button>
                            </div>
                         </li>';

                }

            }
        }
        else
        {
            $output = '';

        }
        $data = array(
            'data'  => $output,

        );

        echo json_encode($data);
    }

}
