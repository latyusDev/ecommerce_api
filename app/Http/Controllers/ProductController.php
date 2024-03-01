<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

      /**
     * generate products randomly from db.
     */
    public function getRandomProduct()
    {
        $products = Product::inRandomOrder()->limit(10)->get();
        return $products;
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreProductRequest $request)
    {
        $productDetail = $request->all();
        $productDetail['image'] = asset('/storage/'.$request->file('image')
                                    ->store('images','public'));
        $product = Product::create($productDetail);
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {

        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
         $product->delete();
         return ['message'=>'product deleted'];
    }

    public function checkout(Request $request)
    {       
            // $products = $request->input('payload');
            $products = $request->all();
            // dd($products);
            // // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            // $line_items = [];
            // $totalPrice = 0;
            // foreach($products as $product){
            //     $totalPrice += $product->price;
            //     $line_items[] = [
            //        'price_data'=>[
            //             'currency'=>'ngn',
            //             'product_data'=>[
            //                 'name'=>$product->name
            //             ],
            //             'unit_amount' => $product->price*100,
            //         ],
            //         'quantity' => 2,
            //      ];
            // }

            // $session = \Stripe\Checkout\Session::create([
            //   'line_items' => $line_items,
            //   'mode' => 'payment',
            //   'success_url' =>route('checkout.success',[],true)."?session_id={CHECKOUT_SESSION_ID}",
            //   'cancel_url' =>route('checkout.cancel',[],true),
            // ]);

            // $order = new Order();
            // $order->status = 'pending';
            // $order->price = $totalPrice;
            // $order->session_id = $session->id;
            // $order->save();
            // return redirect($session->url);

            
    
            // $products = [
            //     [
            //         'name'=>'tecno',
            //         'price'=>343.7
            //     ],
            //     [
            //         'name'=>'itel',
            //         'price'=>343.7
            //     ],
            //     [
            //         'name'=>'samsung',
            //         'price'=>343.7
            //     ],
            //     [
            //         'name'=>'tecno',
            //         'price'=>343.7
            //     ],
            // ];

            $order = Order::create([
                'user_id'=>1,
                'session_id'=>'yryryyhh',
                'total_price'=>5436.5
            ]);
            // $orderItems = [];
             foreach($products as $key => $product){
              $p =  $order->orderItems()->create($product);

                //  $product->order_id = $order->id;
                //  OrderItem::create($product);
             }
            // return     $orderItems;
            //  dd($orderItems[0]);
            $products['order_id'] = $order->id;
            $get = [
                [
                    
                        "name"=> "ete",
                        "count"=> 2,
                        "quantity"=> 3,
                        "image"=> "fffj",
                        "price"=> 3543.3,
                        "description"=> "jfjfj",
                       
                ],
                [
                    
                    "name"=> "ete",
                    "count"=> 2,
                    "quantity"=> 3,
                    "image"=> "fffj",
                    "price"=> 3543.3,
                    "description"=> "jfjfj",
                   
            ]
                ];
              $p =  $order->orderItems()->createMany($products);
            //  print_r($orderItems);
            // $items = OrderItem::createMany($get);
            return $p;
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');
        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        // dd($session);

        if(!$session){
            abort(404);
        }
        $order = Order::where(['session_id'=>$session->id,'status'=>'pending'])->first();
        // dd($order);

        if(!$order){
            abort(404);
        }
        $order->status = 'paid';
        dd($order);

        // $customer = \Stripe\Customer::retrieve($session->id);
        // dd($customer);
        return view('success',['customer'=>$session->customer_details]);
    }

}
