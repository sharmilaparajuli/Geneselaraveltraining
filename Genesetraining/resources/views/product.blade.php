@extends('product-layout')
@section('content')
@section('menu')

@include('includes/menu')


@endsection

<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
                    <h1>Products</h1>
                    <h2><a>{{$product -> product_name}}</a></h2>
                        <p>{{$product['product_desc']}}</p>
                            <p>{{$product['price']}}</p>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
<article>
   
</article>



@endsection