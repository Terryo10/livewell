@extends('layouts.app')

@section('content')
<!--=========================-->
<!--=        Breadcrumb         =-->
<!--=========================-->
<section class="breadcrumb_area">
	<div class="vigo_container_two">
		<div class="page_header">
			<h1>{{$post->title}}</h1>
		</div>
		<!-- /.page-header -->
	</div>
	<!-- /.vigo_container_two -->
</section>
<!-- /.breadcrumb_area -->

<!--==========================-->
<!--=        Video         =-->
<!--==========================-->
<livewire:single-post :post="$post">

<!--==========================-->
<!--=        Video         =-->
<!--==========================-->
<section class="call_to_action_green">
	<div class="vigo_container_two">
		<div class="call_to_action_area_two">
			<div class="row">
				<div class="col-xl-10 offset-xl-2">
					<div class="call_to_action_hello">
						<div class="call_to_action_left_two">
							<h2>LIVE HEALTHY?</h2>
							<p>Try out our suppliment & enjoy the healthiest life. Discounts end soon!</p>
						</div>
						<div class="call_to_action_right_two">
							<a href="#" class="btn_four">Purchase</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection