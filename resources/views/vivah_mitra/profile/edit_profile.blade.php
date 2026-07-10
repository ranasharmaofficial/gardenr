@extends('vivah_mitra.layouts.master')
@section('title') Edit Profile @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 5px;
		box-shadow: 0 6px 14px rgba(0,0,0,0.08);
		transition: 0.3s;
		text-align: center;
	}
	 
	
	.profile-area {
		margin-top: -150px !important;
		margin-bottom: 30px !important;
	}
	
	/* edit profil section */
	
	.edit-profile-section{
		padding:16px;
	}

	.edit-profile-card{
		background:#fff;
		border-radius:22px;
		box-shadow:0 12px 30px rgba(0,0,0,0.08);
		overflow:hidden;
	}

	/* Image top */
	.edit-profile-top {
		background: linear-gradient(135deg, #7b4cc9, #8f6be0);
		height: 128px;
		display: flex;
		justify-content: center;
		align-items: flex-end;
		padding-bottom: 4px;
	}

	.image-wrapper{
		position:relative;
		cursor:pointer;
	}

	.image-wrapper img{
		width:120px;
		height:120px;
		border-radius:50%;
		object-fit:cover;
		border:5px solid #fff;
		background:#fff;
	}

	/* Edit icon */
	.edit-icon{
		position:absolute;
		bottom:6px;
		right:6px;
		background:#6a3dd9;
		color:#fff;
		width:28px;
		height:28px;
		border-radius:50%;
		display:flex;
		align-items:center;
		justify-content:center;
		font-size:14px;
		box-shadow:0 4px 10px rgba(0,0,0,0.2);
	}

	/* Body */
	.edit-profile-body{
		padding:20px;
	}

	.edit-profile-body label{
		font-size:13px;
		font-weight:500;
		color:#555;
		margin-bottom:4px;
	}

	.edit-profile-body .form-group{
		margin-bottom:14px;
	}

	.edit-profile-body .form-control{
		border-radius:12px;
		font-size:14px;
		padding:10px 12px;
	}
	
	 
	</style>

   <!-- Header -->
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewbox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"></path>
							</svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h5 class="mb-0">Edit Profile</h5>
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

     @include('vivah_mitra.includes.sidebar')

    <!-- Page Content -->
    <div class="page-content bottom-content ">
        <div class="dz-banner-heading">
            <div class="overlay-black-light">
                <img src="{{ static_asset('assets/assets_vivah_mitra/images/bg2.png') }}" class="bnr-img" alt="">
            </div>
        </div>
        <div class="container profile-area">
			{{--
			<section class="profile-card-section">
				<div class="profile-card">

					<div class="profile-top">
						<img src="{{ static_asset($vivah_mitra_details->profile_pic) }}" class="profile-avatar" alt="Profile">
					</div>

					

					<div class="profile-body text-center">
						<h4 class="profile-name">{{ $vivah_mitra_details->first_name }}</h4>

						<span class="designation-badge">
							{{ $designationName }}
						</span>

						<div class="profile-info">
							<div class="info-row">
								<span class="info-label">Employee Code</span>
								<span class="info-value">{{ $vivah_mitra_details->employee_code }}</span>
							</div>

							<div class="info-row">
								<span class="info-label">Mobile</span>
								<span class="info-value">{{ $vivah_mitra_details->mobile }}</span>
							</div>
						</div>

						 
					</div>

				</div>
			</section>
			
			--}}
			@php	
						$designationName = \App\Models\MasterDesignation::where('id', $vivah_mitra_details->user_designation_id)->value('name');
					@endphp
			<section class="edit-profile-section">
				<div class="edit-profile-card">
					<form method="post" action="{{ route('member.vivahMitra.updateProfile') }}" id="profile-form" enctype="multipart/form-data">
						@csrf
						<!-- Profile Image -->
						<div class="edit-profile-top">
							<label for="profile_image" class="image-wrapper">
								<img id="profilePreview" src="{{ static_asset($vivah_mitra_details->profile_pic) }}" alt="Profile Image" >
								<span class="edit-icon">✎</span>
							</label>

							<input type="file" id="profile_image" name="profile_pic" accept="image/*" hidden onchange="previewProfileImage(event)">
						</div>

						<!-- Form -->
						<div class="edit-profile-body">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" readonly value="{{ $vivah_mitra_details->first_name }}">
							</div>

							<div class="form-group">
								<label>Designation</label>
								<input type="text" class="form-control" value="{{ $designationName }}" readonly >
							</div>

							<div class="form-group">
								<label>Vivah Mitra Code</label>
								<input type="text" class="form-control" value="{{ $vivah_mitra_details->employee_code }}" readonly
								>
							</div>

							<div class="form-group">
								<label>Mobile</label>
								<input type="text" readonly class="form-control" value="{{ $vivah_mitra_details->mobile }}" >
							</div>

							<button class="btn btn-primary w-100 mt-2 saveBtn">
								Save Changes
							</button>
						</div>
					</form>

				</div>
			</section>

             
             
             
        </div>
    </div>
    <!-- Page Content End-->
	
 


    <!-- Page Content End-->
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	 <script>
function previewProfileImage(event){
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('profilePreview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

 
document.getElementById('profile-form').addEventListener('submit', function(e){
    e.preventDefault();

    const form = this;
    const btn  = form.querySelector('.saveBtn');
    const formData = new FormData(form);

    btn.disabled = true;
    btn.innerHTML = 'Saving...';

    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(async response => {
        btn.disabled = false;
        btn.innerHTML = 'Save Changes';

        if (!response.ok) {
            const errorData = await response.json();
            showErrors(errorData.errors);
            return;
        }

        const data = await response.json();
         
		Swal.fire({
			icon: "success",
			title: "Success",
			text: data.message || 'Profile updated successfully',
			timer: 1500,
			showConfirmButton: false
		});
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = 'Save Changes';
        Swal.fire({
			icon: "error",
			title: "Oh No!",
			text: data.message || 'Something Went Wrong',
			timer: 1500,
			showConfirmButton: false
		});
    });
});

/* Show validation errors */
function showErrors(errors){
    let msg = '';
    Object.values(errors).forEach(err => {
        msg += err[0] + '\n';
    });
    alert(msg);
}

/* Image preview */
function previewProfileImage(event){
    const reader = new FileReader();
    reader.onload = () => {
        document.getElementById('profilePreview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
 


</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
