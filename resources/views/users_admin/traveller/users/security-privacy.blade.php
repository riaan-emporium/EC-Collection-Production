@extends('users_admin.traveller.layout.app')
@section('content')

							<div class="mt-15">
								<a href="https://www.iubenda.com/privacy-policy/70156957"
									class="iubenda-white iubenda-noiframe iubenda-embed iub-legal-only iubenda-noiframe "
									title="Privacy Policy ">Privacy Policy</a>
								<script
									type="text/javascript">(function (w, d) { var loader = function () { var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s, tag); }; if (w.addEventListener) { w.addEventListener("load", loader, false); } else if (w.attachEvent) { w.attachEvent("onload", loader); } else { w.onload = loader; } })(window, document);</script>

								<a href="https://www.iubenda.com/privacy-policy/70156957/cookie-policy"
									class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe "
									title="Cookie Policy ">Cookie Policy</a>
								<script
									type="text/javascript">(function (w, d) { var loader = function () { var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src = "https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s, tag); }; if (w.addEventListener) { w.addEventListener("load", loader, false); } else if (w.attachEvent) { w.attachEvent("onload", loader); } else { w.onload = loader; } })(window, document);</script>
								<!-- <a href="#" class="btn btn-outline-dark mb-5 mr-5">
									<i class="fas fa-info-circle"></i>
									Emporium-Collection Privacy Policy
								</a> -->
								<!-- <a href="#" class="btn btn-outline-dark mb-5">
									<i class="fas fa-info-circle"></i>
									Cookie Policy
								</a> -->
							</div>
							<div class="mt-15">
								Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero rerum temporibus quas
								nulla dolorem non rem porro amet tenetur vero nostrum explicabo, hic atque quo delectus
								illum! Delectus, natus est.
							</div>
							<div class="mt-15">
								<div class="card card-custom">
									<div class="card-header align-items-center px-0">
										<div class="col-9 pl-0">
											<h2 class="text-dark font-weight-bold font-saol">
												Password
											</h2>
										</div>
										<div class="col-3 pr-0 text-right">
											<a href="#setPassword" data-toggle="modal"
												class="btn btn-light-primary font-weight-bolder">
												<i class="flaticon-edit pr-0"></i>
											</a>
										</div>
									</div>
									<div class="card-body px-0">
										<div class="section-icon d-flex">
											<div class="checked-ico">
												<i class="flaticon2-check-mark"></i>
											</div>
											<div class="password-check-content">
												<div class="font-weight-bolder">Password has been set</div>
												<div>Choose a strong, unique password that's at least 8 characters long.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mt-15">
								<div class="card card-custom">
									<div class="card-header align-items-center px-0">
										<div class="col-9 pl-0">
											<h2 class="text-dark font-weight-bold font-saol">
												Two-step verification options
											</h2>
											<p>Add an extra layer of security to block unauthorized access and protect
												yout account.</p>
										</div>
										<div class="col-3 pr-0 text-right">
											<a href="#" class="btn btn-light-primary font-weight-bolder">
												<i class="flaticon2-settings pr-0"></i>
											</a>
										</div>
									</div>
									<div class="card-body px-0">
										<div class="authorized-list">
											<div class="row align-items-center">
												<div class="col-md-8 mb-4">
													<p>
														<span class="font-weight-bolder">Authenticator app code</span>
														<a href="#helpAuth" data-toggle="modal" class="ml-1"><i
																class="flaticon-questions-circular-button"></i></a>
														<span class="text-muted"> (Recommended)</span>
													</p>
													<p class="mb-0">Enter a code generated by your authenticator app to
														confirm it's you.</p>
												</div>
												<div class="col-md-4 mb-4 text-right">
													<a href="#" class="btn btn-secondary">Disable</a>
												</div>
											</div>
										</div>
										<div class="authorized-list">
											<div class="row align-items-center">
												<div class="col-md-8 mb-4">
													<p>
														<span class="font-weight-bolder">Mobile app prompt</span> <a
															href="#helpPrompt" data-toggle="modal" class="ml-1"><i
																class="flaticon-questions-circular-button"></i></a>
													</p>
													<p class="mb-0">Receive a prompt from your mobile app to confirm
														it's you.</p>
												</div>
												<div class="col-md-4 mb-4 text-right">
													<a href="#" class="btn btn-primary">Enable</a>
												</div>
											</div>
										</div>
										<div class="authorized-list">
											<div class="row align-items-center">
												<div class="col-md-8 mb-4">
													<p>
														<span class="font-weight-bolder">Text message </span> <a
															href="#helpText" data-toggle="modal" class="ml-1"><i
																class="flaticon-questions-circular-button"></i></a>
													</p>
													<p class="mb-0">Receive a six digit code by text message to confirm
														it's you.</p>
												</div>
												<div class="col-md-4 mb-4 text-right">
													<a href="#" class="btn btn-primary">Enable</a>
												</div>
											</div>
										</div>
										<div class="authorized-list">
											<div class="row align-items-center">
												<div class="col-md-8 mb-4">
													<p>
														<span class="font-weight-bolder">Security question </span> <a
															href="#helpSecurity" data-toggle="modal" class="ml-1"><i
																class="flaticon-questions-circular-button"></i></a>
													</p>
													<div class="section-icon d-flex">
														<div class="checked-ico">
															<i class="flaticon2-check-mark"></i>
														</div>
														<div class="password-check-content">
															<div class="font-weight-bolder">Enabled</div>
															<div>
																Answer a question you choose to confirm it's you.
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4 mb-4 text-right">
													<a href="#setQuestion" data-toggle="modal"
														class="btn btn-light-primary font-weight-bolder">
														<i class="flaticon-edit pr-0"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="setPassword" data-backdrop="static" tabindex="-1" role="dialog"
						aria-labelledby="staticBackdrop" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Password</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<i aria-hidden="true" class="ki ki-close"></i>
									</button>
								</div>
								<form method="post" action="/users/password">
									<div class="modal-body">
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" class="form-control">
										</div>
										<div class="form-group">
											<label>Confirm Password</label>
											<input type="password" name="password_confirmation" class="form-control">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light-primary font-weight-bold"
											data-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary font-weight-bold"
											data-dismiss="modal">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="modal fade" id="setQuestion" data-backdrop="static" tabindex="-1" role="dialog"
						aria-labelledby="staticBackdrop" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Security Questions</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<i aria-hidden="true" class="ki ki-close"></i>
									</button>
								</div>
								<form action="#">
									<div class="modal-body">
										<p>We'll use these questions as a way to make sure it's your account, like if you need to reset
											your password</p>
										<div class="form-group">
											<label>Security question 1</label>
											<select class="form-control mb-4">
												<option value="Select a question">Select a question</option>
												<option value="What was the name of your first school?">
													What was the name of your first school?
												</option>
												<option value="What was the name of your first pet?">
													What was the name of your first pet?
												</option>
												<option value="What's the name of the hospital in which you were born?">
													What's the name of the hospital in which
													you were born?
												</option>
												<option value="What's the nickname of your oldest child?">
													What's the nickname of your oldest child?
												</option>
												<option value="What is the middle name of your father?">
													What is the middle name of your father?
												</option>
												<option value="What's the name of your favorite childhood cuddly toy?">
													What's the name of your favorite childhood
													cuddly toy?
												</option>
												<option value="Who was your first roommate?">
													Who was your first roommate?</option>
												<option value="What is the maiden name of grandmother?">
													What is the maiden name of grandmother?
												</option>
											</select>
											<input type="text" class="form-control" placeholder="Answer">
										</div>
										<div class="form-group">
											<label>Security question 2</label>
											<select class="form-control mb-4">
												<option value="Select a question">Select a question</option>
												<option value="What was the name of your first school?">
													What was the name of your first school?
												</option>
												<option value="What was the name of your first pet?">
													What was the name of your first pet?
												</option>
												<option value="What's the name of the hospital in which you were born?">
													What's the name of the hospital in which
													you were born?
												</option>
												<option value="What's the nickname of your oldest child?">
													What's the nickname of your oldest child?
												</option>
												<option value="What is the middle name of your father?">
													What is the middle name of your father?
												</option>
												<option value="What's the name of your favorite childhood cuddly toy?">
													What's the name of your favorite childhood
													cuddly toy?
												</option>s
												<option value="Who was your first roommate?">
													Who was your first roommate?</option>
												<option value="What is the maiden name of grandmother?">
													What is the maiden name of grandmother?
												</option>
											</select>
											<input type="text" class="form-control" placeholder="Answer">
										</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light-primary font-weight-bold"
											data-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary font-weight-bold"
											data-dismiss="modal">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--end::Card-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Entry-->
		</div>
		<!--end::Content-->
@endsection