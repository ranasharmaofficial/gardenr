
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
            <span class="input-group">
              <input type="search" class="form-control px-2 " placeholder="Search..." aria-label="Username">
              <a href="javascript:void(0);" class="input-group-text bg-primary text-fixed-white" id="Search-Grid"><i class="fe fe-search header-link-icon fs-18"></i></a>
            </span>
            <div class="mt-3">
              <div class="">
                  <p class="fw-semibold text-muted mb-2 fs-13">Recent Searches</p>
                  <div class="ps-2">
                      <a  href="javascript:void(0)" class="search-tags"><i class="fe fe-search me-2"></i>People<span></span></a>
                      <a  href="javascript:void(0)" class="search-tags"><i class="fe fe-search me-2"></i>Pages<span></span></a>
                      <a  href="javascript:void(0)" class="search-tags"><i class="fe fe-search me-2"></i>Articles<span></span></a>
                  </div>
              </div>
              <div class="mt-3">
                  <p class="fw-semibold text-muted mb-2 fs-13">Apps and pages</p>
                  <ul class="ps-2">
                      <li class="p-1 d-flex align-items-center text-muted mb-2 search-app">
                          <a href="full-calendar.html"><span><i class='bx bx-calendar me-2 fs-14 bg-primary-transparent p-2 rounded-circle '></i>Calendar</span></a>
                      </li>
                      <li class="p-1 d-flex align-items-center text-muted mb-2 search-app">
                          <a href="mail.html"><span><i class='bx bx-envelope me-2 fs-14 bg-primary-transparent p-2 rounded-circle'></i>Mail</span></a>
                      </li>
                      <li class="p-1 d-flex align-items-center text-muted mb-2 search-app">
                          <a href="buttons.html"><span><i class='bx bx-dice-1 me-2 fs-14 bg-primary-transparent p-2 rounded-circle '></i>Buttons</span></a>
                      </li>
                  </ul>
              </div>
              <div class="mt-3">
                <p class="fw-semibold text-muted mb-2 fs-13">Links</p>
                <ul class="ps-2 list-unstyled">
                    <li class="p-1 align-items-center  mb-1 search-app">
                            <a href="javascript:void(0)" class="text-primary"><u>http://spruko/html/spruko.com</u></a>
                    </li>
                    <li class="p-1 align-items-center mb-1 search-app">
                            <a href="javascript:void(0)"  class="text-primary"><u>http://spruko/demo/spruko.com</u></a>
                    </li>
                </ul>
              </div>
            </div>
        </div>
        <div class="modal-footer d-block">
          <div class="text-center">
              <a href="javascript:void(0)" class="text-primary text-decoration-underline fs-15">View all results</a>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Footer Start -->
<footer class="footer mt-auto py-3 bg-white text-center">
  <div class="container">
      <span class="text-muted"> Copyright © <span id="years">{{ date('Y') }}</span> <a
              href="javascript:void(0);" class="text-dark fw-semibold">{{ env('APP_NAME') }}</a>.
  All
          rights
          reserved
      </span>
  </div>
</footer>
<!-- Footer End -->


<!-- Sidebar-right -->
<div class="sidebar offcanvas offcanvas-end sidebar-right" tabindex="-1" id="sidebar-right">
  <div class="offcanvas-body position-relative p-0">
      <ul class="Date-time">
          <li class="time">
              <h1 class="animated ">21:00</h1>
              <p class="animated ">Sat,October 1st 2029</p>
          </li>
      </ul>
      <div class="card-body p-4 latest-tasks">
          <p class="events-title"><span>Events For Week </span></p>
          <div class="event">
              <div class="Day">Monday 20 Jan</div> <a href="javascript:void(0);">No Events Today</a>
          </div>
          <div class="event">
              <div class="Day">Tuesday 21 Jan</div> <a href="javascript:void(0);">No Events Today</a>
          </div>
          <div class="event">
              <div class="Day">Wednessday 22 Jan</div>
              <div class="tasks">
                  <div class=" task-line primary">
                      <a href="javascript:void(0);" class="label"> XML Import &amp; Export </a>
                      <div class="time"> 12:00 PM </div>
                  </div>
                  <div>
                      <input class="form-check-input" type="checkbox" value="" checked>
                  </div>
              </div>
              <div class="tasks">
                  <div class="task-line danger">
                      <a href="javascript:void(0);" class="label"> Connect API to pages </a>
                      <div class="time"> 08:00 AM </div>
                  </div>
                  <div>
                      <input class="form-check-input" type="checkbox" value="">
                  </div>
              </div>
          </div>
          <div class="event">
              <div class="Day">Thursday 23 Jan</div>
              <div class="tasks">
                  <div class="task-line success">
                      <a href="javascript:void(0);" class="label"> Create Wireframes </a>
                      <div class="time"> 06:20 PM </div>
                  </div>
                  <div>
                      <input class="form-check-input" type="checkbox" value="">
                  </div>
              </div>
          </div>
          <div class="event">
              <div class="Day">Friday 24 Jan</div>
              <div class="tasks">
                  <div class="task-line warning">
                      <a href="javascript:void(0);" class="label"> Test new features in tablets</a>
                      <div class="time"> 02: 00 PM </div>
                  </div>
                  <div>
                      <input class="form-check-input" type="checkbox" value="">
                  </div>
              </div>
              <div class="tasks">
                  <div class="task-line teal">
                      <a href="javascript:void(0);" class="label"> Design Ecommerce </a>
                      <div class="time"> 10: 00 PM </div>
                  </div>
                  <div>
                      <input class="form-check-input" type="checkbox" value="">
                  </div>
              </div>
              <div class="tasks mb-0">
                  <div class="task-line purple">
                      <a href="javascript:void(0);" class="label"> Fix Validation Issues </a>
                      <div class="time"> 12: 00 AM </div>
                  </div>
                  <div>
                      <input class="form-check-input" type="checkbox" value="">
                  </div>
              </div>
          </div>
          <div class="d-flex pagination wd-100p">
              <a href="javascript:void(0);">Previous</a>
              <a href="javascript:void(0);" class="ms-auto">Next</a>
          </div>
      </div>
      <div class="card-body border-top p-4">
          <div class="row">
              <div class="col-4 text-center">
                  <a class="text-primary" href=""><i class="dropdown-icon mdi  mdi-message-outline fs-20 m-0"></i></a>
                  <div>Inbox</div>
              </div>
              <div class="col-4 text-center">
                  <a class="text-primary" href=""><i class="dropdown-icon mdi mdi-tune fs-20 m-0"></i></a>
                  <div>Settings</div>
              </div>
              <div class="col-4 text-center">
                  <a class="text-primary" href=""><i class="dropdown-icon mdi mdi-logout-variant fs-20 m-0"></i></a>
                  <div>Sign out</div>
              </div>
          </div>
      </div>
  </div>
</div>
<!--/Sidebar-right-->
