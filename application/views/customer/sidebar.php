<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?= base_url(); ?>" class="app-brand-link">
			<span class="app-brand-logo demo">
				<span style="color: var(--bs-primary)">
					<svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z" fill="currentColor" />
						<path d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z" fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
						<path d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z" fill="currentColor" />
						<path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="currentColor" />
						<path d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z" fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
						<path d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z" fill="currentColor" />
						<defs>
							<linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532" y2="24.104" gradientUnits="userSpaceOnUse">
								<stop offset="0" stop-opacity="1" />
								<stop offset="1" stop-opacity="0" />
							</linearGradient>
							<linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357" y2="24.1155" gradientUnits="userSpaceOnUse">
								<stop offset="0" stop-opacity="1" />
								<stop offset="1" stop-opacity="0" />
							</linearGradient>
						</defs>
					</svg>
				</span>
			</span>
			<span class="app-brand-text demo menu-text fw-bold ms-2">Materialize</span>
		</a>
		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
			<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z" fill="currentColor" fill-opacity="0.6" />
				<path d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z" fill="currentColor" fill-opacity="0.38" />
			</svg>
		</a>
	</div>
	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<li class="menu-item <?= is_active('customer/dashboard') ?>">
			<a href="<?= base_url('customer/dashboard'); ?>" class="menu-link">
				<i class="menu-icon tf-icons mdi mdi-home-outline"></i>
				<div data-i18n="Dashboards">Dashboards</div>
			</a>
		</li>
	</ul>
</aside>
<div class="layout-page">
	<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
		<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
			<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
				<i class="mdi mdi-menu mdi-24px"></i>
			</a>
		</div>
		<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
			<div class="navbar-nav align-items-center">
				<div class="nav-item navbar-search-wrapper mb-0">
					<a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
						<i class="mdi mdi-magnify mdi-24px scaleX-n1-rtl"></i>
						<span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
					</a>
				</div>
			</div>
			<ul class="navbar-nav flex-row align-items-center ms-auto">
				<!-- User -->
				<li class="nav-item navbar-dropdown dropdown-user dropdown">
					<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
						<div class="avatar avatar-online">
							<img src="<?= base_url() ?>assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
						</div>
					</a>
					<ul class="dropdown-menu dropdown-menu-end">
						<li>
							<a class="dropdown-item" href="pages-account-settings-account.html">
								<div class="d-flex">
									<div class="flex-shrink-0 me-3">
										<div class="avatar avatar-online">
											<img src="<?= base_url() ?>assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
										</div>
									</div>
									<div class="flex-grow-1">
										<span class="fw-medium d-block">
											<?= $this->session->userdata('login')['username']; ?>
										</span>
										<small class="text-muted">
											<?= $this->session->userdata('login')['user_type']; ?>
										</small>
									</div>
								</div>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a class="dropdown-item" href="pages-profile-user.html">
								<i class="mdi mdi-account-outline me-2"></i>
								<span class="align-middle">My Profile</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a class="dropdown-item" href="<?= base_url("change_password") ?>">
								<i class="mdi mdi-lock-outline me-2"></i>
								<span class="align-middle">Change Password</span>
							</a>
						</li>
						<li>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a class="dropdown-item" href="<?= base_url("login/logout") ?>" onclick="return confirm('Are you sure?');">
								<i class="mdi mdi-logout me-2"></i>
								<span class="align-middle">Log Out</span>
							</a>
						</li>
					</ul>
				</li>

			</ul>
		</div>
		<div class="navbar-search-wrapper search-input-wrapper d-none">
			<input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search..." />
			<i class="mdi mdi-close search-toggler cursor-pointer"></i>
		</div>
	</nav>
