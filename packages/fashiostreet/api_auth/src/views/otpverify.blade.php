@extends('api_auth::layout.mainlayout')
@section('title','fashiostreet mobile number verification')
@section('content')
				@php
					if(!isset($_GET['mobile']))
					{
						abort(404,'Invalid url found');
					}
				@endphp
                <form id="otpverify_form" class="white" action="/action_page.php">
                    <center><img src="{{ asset('assets/img/fashiostreet-icon.png') }}" style="width:80px"/>
                        <h2>Fashio<span class="green">street</span></h2>
                        <h3>Mobile number verification</h3>
                    </center><br/>
                    <h5 class="green" style="font-size:16px;">
                        OTP already Send to your mobile number : <span id="mobile_txt" class="white">{{ $_GET['mobile'] }}</span>
                    </h5><br/>
                    <div id="error" class="error">
                    </div>
                    <div class="form-group">
                        <label for="OTP" class="white">Enter OTP:</label>
                        <input type="number" class="form-control" id="OTP_txt" placeholder="Enter OTP" required>
                    </div>
                    <button type="button" class="btn btn-default" id="resendOTP_btn">Resend OTP</button>
                    <a href="forgetpassword" style="float: right" class="link green">Change mobile number</a>
                    <br/><br/><button type="submit" class="btn btn-fashio">Verify OTP</button>
                </form><br/>
                <center>
                    <p><a href="login" style="font-size:16px;" class="link white">Already have account? Signin </a></p>
                </center>
				<script>
					$(document).ready(function(){
						$('#resendOTP_btn').click(function(){
							var mobile = {{ $_GET['mobile'] }};
							var data = {
								'mobile' : mobile
							};
							$.ajax({
								type:'POST',
								url:'/api/auth/register/resendOTP',
								dataType:'json',
								data:data,
								success:function (response) {
									$('#error').show().html(response);
								},
								error:function (request, status, error) {
								    var error = request.responseText.result;
								    if(erorr != null || error != undefined)
                                        $('#error').show().html(error);
								    else
                                        $('#error').show().html('server error found,try again or contact our service');
								}
							});
						});
					});
				</script>

@endsection