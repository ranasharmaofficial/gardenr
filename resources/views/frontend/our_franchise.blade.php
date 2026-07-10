@extends('frontend.layouts.master')

@section('title')
Our Franchise
@endsection

@section('description')
@endsection


@section('content')

<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{ static_asset('assets/assets_web/images/header-about5.jpg') }}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Our Franchise</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Our Franchise </li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->
  <section id="ed-cp-form" class="ed-cp-form-sec position-relative">
  <div class="container">
  <div class="row">
  <div class="ed-cp-form-content  pb-155 position-relative">
				<div class="ed-cp-form position-relative">
					<div class="gt-client-review-form mt-40">
						<h3 class="text-center">Search Franchise</h3>
						<form action="#" method="get">
							<div class="row">
								<div class="col-md-5">
									<div class="ed-cp-select">
										<select>
											<option>Select State</option>
											<option>Bihar</option>
											<option>Jharkhand</option>
											<option>U.P</option>
										</select>
									</div>
								</div>
								<div class="col-md-5">
									 <div class="ed-cp-select">
										<select>
											<option>Select District</option>
											<option>Patna</option>
											<option>Muzaffarpur</option>
											<option>Chappra</option>
											<option>Madhunabi</option>
											<option>Samstipur</option>
											<option>West Champaran</option>
											<option>East Champaran</option>
											<option>Purnia</option>
										</select>
									</div>
								</div>


								<div class="col-md-2">
									<button>Search</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
  </div>
  </div>
  </section>




<section id="ed-cp-form" class="ed-cp-form-sec position-relative">
  <div class="container">
    <div class="card">
      <h1>Our Franchise List — Bihar Skill Academy</h1>

      <div class="toolbar">
        <input type="search" id="search" placeholder="Search franchise, city, contact..." />
        <button class="btn" id="exportCsv">Export CSV</button>
        <button class="btn ghost" id="clearSearch">Clear</button>
        <div style="margin-left:auto" class="small">Showing <span id="count">0</span> records</div>
      </div>

      <div style="overflow:auto">
        <table id="franchiseTable" aria-describedby="franchiseDescription">
          <thead>
            <tr>
              <th class="sortable" data-key="centerId">Center ID</th>
              <th class="sortable" data-key="name">Franchise Name</th>
              <th class="sortable" data-key="city">City</th>
              <th class="sortable" data-key="district">District</th>
              <th class="sortable" data-key="contact">Contact Person</th>
              <th class="sortable" data-key="phone">Phone</th>
              <th class="sortable" data-key="email">Email</th>
              <th class="sortable" data-key="est">Established</th>
              <th class="sortable" data-key="status">Status</th>

            </tr>
          </thead>
          <tbody id="tbody">
            <!-- Sample rows — replace with server data -->
            <tr>
              <td data-label="Center ID">BSA-001</td>
              <td data-label="Franchise Name">Bihar Skill Center — Patna</td>
              <td data-label="City">Patna</td>
              <td data-label="District">Patna</td>
              <td data-label="Contact Person">Rakesh Kumar</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">patna@biharskillacademy.com</td>
              <td data-label="Established">15-03-2019</td>
              <td data-label="Status"><span class="status active">Active</span></td>

            </tr>

            <tr>
              <td data-label="Center ID">BSA-002</td>
              <td data-label="Franchise Name">BSA — Muzaffarpur</td>
              <td data-label="City">Muzaffarpur</td>
              <td data-label="District">Muzaffarpur</td>
              <td data-label="Contact Person">Suman Devi</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">muzaffarpur@biharskillacademy.com</td>
              <td data-label="Established">04-06-2020</td>
              <td data-label="Status"><span class="status active">Active</span></td>

            </tr>

            <tr>
              <td data-label="Center ID">BSA-010</td>
              <td data-label="Franchise Name">Chhapra Skill Hub</td>
              <td data-label="City">Chhapra</td>
              <td data-label="District">Saran</td>
              <td data-label="Contact Person">Anil Prasad</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">chhapra@biharskillacademy.com</td>
              <td data-label="Established">01-11-2021</td>
              <td data-label="Status"><span class="status inactive">Inactive</span></td>

            </tr>

            <tr>
              <td data-label="Center ID">BSA-005</td>
              <td data-label="Franchise Name">Gaya Training Center</td>
              <td data-label="City">Gaya</td>
              <td data-label="District">Gaya</td>
              <td data-label="Contact Person">Mrs. Shalini</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">gaya@biharskillacademy.com</td>
              <td data-label="Established">12-08-2018</td>
              <td data-label="Status"><span class="status active">Active</span></td>

            </tr>

            <tr>
              <td data-label="Center ID">BSA-007</td>
              <td data-label="Franchise Name">Bhagalpur Skill Academy</td>
              <td data-label="City">Bhagalpur</td>
              <td data-label="District">Bhagalpur</td>
              <td data-label="Contact Person">Amit Jha</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">bhagalpur@biharskillacademy.com</td>
              <td data-label="Established">20-01-2022</td>
              <td data-label="Status"><span class="status active">Active</span></td>

            </tr>

            <tr>
              <td data-label="Center ID">BSA-011</td>
              <td data-label="Franchise Name">Purnia Training Point</td>
              <td data-label="City">Purnia</td>
              <td data-label="District">Purnia</td>
              <td data-label="Contact Person">Md. Farooq</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">purnia@biharskillacademy.com</td>
              <td data-label="Established">05-07-2023</td>
              <td data-label="Status"><span class="status active">Active</span></td>

            </tr>

            <tr>
              <td data-label="Center ID">BSA-020</td>
              <td data-label="Franchise Name">Darbhanga Skill Center</td>
              <td data-label="City">Darbhanga</td>
              <td data-label="District">Darbhanga</td>
              <td data-label="Contact Person">Pooja Kumari</td>
              <td data-label="Phone">+91 00000 00000</td>
              <td data-label="Email">darbhanga@biharskillacademy.com</td>
              <td data-label="Established">17-02-2020</td>
              <td data-label="Status"><span class="status inactive">Inactive</span></td>

            </tr>

          </tbody>
        </table>
      </div>

    </div>
  </div>
  </section>


@if(false)
<style>
	select {
		height: 45px;
		width: 100%;
		border: none;
		outline: none;
		padding: 0 20px;
		line-height: 58px;
		font-size: 14px;
		color: var(--it-common-black);
	}
</style>
<main>
    <div class="it-breadcrumb-area fix it-breadcrumb-bg p-relative" data-background="{{static_asset('assets/assets_web/images/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="it-breadcrumb-content z-index-3 text-center">
                        <div class="it-breadcrumb-title-box">
                            <h3 class="it-breadcrumb-title">Franchise</h3>
                        </div>
                        <div class="it-breadcrumb-list-wrap">
                            <div class="it-breadcrumb-list">
                                <span><a href="{{ url('') }}">home</a></span>
                                <span class="dvdr">//</span>
                                <span>Our Franchise</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider-area-end -->
    <div class="it-course-area ed-course-bg ed-course-style-3 p-relative pt-30"
        data-background="{{ static_asset('assets/assets_web/images/ed-bg-1.jpg') }}">
        <div class="container">

				<form method="get" action="" class="row">
					@csrf
					<div class="col-xl-4 col-lg-4 col-md-4 mb-30 mt-30">
						<div class="it-student-regiform-item">
							<select class="form-control" style="border-radius: 5px;color: #0E2A46;font-size: 16px;font-style: normal;font-weight: 400;text-transform: capitalize;"  required id="fstate" name="state">
								<option selected disabled>Select State*</option>
								@foreach($state_list as $val)
									<option @if($request->state==$val->id) selected @endif value="{{ $val->id }}">{{ $val->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					@php
						$city_details = \App\Models\City::where('id', $request->city)->first();

					@endphp
					<div class="col-xl-4 col-lg-4 col-md-4 mb-30 mt-30">
						<div class="it-student-regiform-item">
							<select class="form-control" style="border-radius: 5px;color: #0E2A46;font-size: 16px;font-style: normal;font-weight: 400;text-transform: capitalize;"  required id="fcity" name="city">
								<option selected disabled>Select City*</option>
								@if($city_details) <option selected value="{{ $city_details->id}}" >{{ $city_details->name }}</option> @endif
							</select>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-2 mb-30 mt-30">
						<div class="it-student-regiform-item">
							<button type="submit" class="it-btn large" style="height: 45px;" name="search">Search</button>
						</div>
					</div>
					<div class="col-xl-2 col-lg-2 col-md-2 mb-30 mt-30">
						<div class="it-student-regiform-item">
							<a href="{{ url('our-franchise') }}" class="it-btn large" style="height: 45px;" name="search">Reset</a>
						</div>
					</div>
				</form>

			@if(!empty($approved_franchise))
            <div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 mb-30 mt-30">
					<table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Training Centre Code</th>
								<th scope="col">Director Name</th>
								<th scope="col">State</th>
								<th scope="col">City</th>

							</tr>
						</thead>
						<tbody>
							@foreach ($approved_franchise as $key => $value)
							@php
								$state = \App\Models\State::where('id', $value->state)->first();
								$city = \App\Models\City::where('id', $value->city)->first();
							@endphp
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ $value->partner_code }}</td>
								<td>{{ $value->first_name.' '.$value->last_name }}</td>
								<td>@if($state) {{ $state->name }} @endif</td>
								<td>@if($city) {{ $city->name }} @endif</td>

							</tr>
							@endforeach
						</tbody>
					</table>
                </div>
            </div>
			@endif
        </div>
    </div>
</main>
@endif
@endsection
