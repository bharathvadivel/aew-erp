<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <!--=========================*
                Met Data
                *===========================-->
                <meta charset="UTF-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--=========================*
              Page Title
              *===========================-->
              <title>ERP</title>

              
          </head>
          <body>

          @include('logics.include.sidemenu')


    <!--==================================*
               Main Content Section
               *====================================-->
               <div class="main-content page-content">

        <!--==================================*
                   Main Section
                   *====================================-->
                   <div class="main-content-inner">
                    <div class="row mb-4">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="d-flex align-items-center dashboard-header flex-wrap mb-3 mb-sm-0">
                                    <h5 class="mr-4 mb-0 font-weight-bold">Dashboard</h5>
                                    <div class="d-flex align-items-baseline dashboard-breadcrumb">
                                        <p class="text-muted mb-0 mr-1 hover-cursor">App</p>
                                        <i class="mdi mdi-chevron-right mr-1 text-muted"></i>
                                        <p class="text-muted mb-0 mr-1 hover-cursor">Dashboard</p>
                                        <i class="mdi mdi-chevron-right mr-1 text-muted"></i>
                                        <p class="text-muted mb-0 hover-cursor">Analytics</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="btn-group mr-3">
                                        <button type="button" class="btn btn-primary">02 Aug 2021</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                                            <a class="dropdown-item" href="#">Sept 2021</a>
                                            <a class="dropdown-item" href="#">Oct 2021</a>
                                            <a class="dropdown-item" href="#">Nov 2021</a>
                                        </div>
                                    </div>
                                    <button class="btn bg-white border d-none d-sm-block">Download Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                            <div class="card mb-mob-4 icon_card primary_card_bg">
                                <!-- Card body -->
                                <div class="card-body">
                                    <p class="card-title mb-0 text-white">Number Of Sales</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 text-white">5,009</h3>
                                        <div class="arrow_icon"><i class="ion-arrow-up-c text-primary"></i></div>
                                    </div>
                                    <p class="mb-0 text-white">1.92% <span class="text-white ml-1"><small>(Since last month)</small></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                            <div class="card mb-mob-4 icon_card success_card_bg">
                                <!-- Card body -->
                                <div class="card-body">
                                    <p class="card-title mb-0 text-white">New Products</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 text-white">94,356</h3>
                                        <div class="arrow_icon"><i class="ion-arrow-down-c text-success"></i></div>
                                    </div>
                                    <p class="mb-0 text-white">1.92% <span class="text-white ml-1"><small>(Since last month)</small></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                            <div class="card mb-mob-4 icon_card warning_card_bg">
                                <!-- Card body -->
                                <div class="card-body">
                                    <p class="card-title mb-0 text-white">New Users</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 text-white">1,253</h3>
                                        <div class="arrow_icon"><i class="ion-arrow-up-c text-warning"></i></div>
                                    </div>
                                    <p class="mb-0 text-white">1.27% <span class="text-white ml-1"><small>(Since last month)</small></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-12 stretched_card">
                            <div class="card mb-mob-4 icon_card info_card_bg">
                                <!-- Card body -->
                                <div class="card-body">
                                    <p class="card-title mb-0 text-white">Today Earning</p>
                                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                                        <h3 class="mb-0 text-white">5,224</h3>
                                        <div class="arrow_icon"><i class="ion-arrow-up-c text-info"></i></div>
                                    </div>
                                    <p class="mb-0 text-white">9.12% <span class="text-white ml-1"><small>(Since last day)</small></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 stretched_card mt-4">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card_title mb-0">User Sales Overview</h4>
                                            <p class="text-muted">Eum perspiciatis autem vero, corporis, itaque placeat voluptates. Molestias molestiae cum fugiat.</p>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-dots-horizontal text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <div class="chart-container">
                                                <canvas id="sales_overview"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-4 stretched_card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h4 class="card_title mb-0">RECENT Average SALES</h4>
                                        </div>
                                        <div>
                                            <i class="mdi mdi-dots-horizontal text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <h1 class="mt-2">$956.78</h1>
                                            <h4 class="mb-2">PER SALE</h4>
                                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque debitis dolor. Cconsectetur adipisicing elit. Atque debitis dolor.</p>
                                            <a href="#" class="btn btn-primary mb-3">View Report</a>
                                            <canvas id="recentSalesDetail"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 mt-4 stretched_card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="card_title">Visitors by Browser</h4>
                                        <div>
                                            <i class="mdi mdi-dots-horizontal text-muted"></i>
                                        </div>
                                    </div>

                                    <div class="browser_section">
                                        <div class="browser_item d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="browser_icon">
                                                    <img src="assets/images/browser/chrome.png" alt="">
                                                </div>
                                                <div>
                                                    <h5>Chrome Users</h5>
                                                    <span class="date_browser">14-03-2021</span>
                                                </div>
                                            </div>
                                            <span class="badge badge-success">+155</span>
                                        </div>
                                        <div class="browser_item d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="browser_icon">
                                                    <img src="assets/images/browser/firefox.png" alt="">
                                                </div>
                                                <div>
                                                    <h5>Chrome Users</h5>
                                                    <span class="date_browser">14-03-2021</span>
                                                </div>
                                            </div>
                                            <span class="badge badge-danger">+54</span>
                                        </div>
                                        <div class="browser_item d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="browser_icon">
                                                    <img src="assets/images/browser/safari.png" alt="">
                                                </div>
                                                <div>
                                                    <h5>Chrome Users</h5>
                                                    <span class="date_browser">14-03-2021</span>
                                                </div>
                                            </div>
                                            <span class="badge badge-success">+22</span>
                                        </div>
                                        <div class="browser_item d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="browser_icon">
                                                    <img src="assets/images/browser/opera.png" alt="">
                                                </div>
                                                <div>
                                                    <h5>Chrome Users</h5>
                                                    <span class="date_browser">14-03-2021</span>
                                                </div>
                                            </div>
                                            <span class="badge badge-success">+22</span>
                                        </div>
                                    </div>
                                    <canvas height="110" id="customers-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 mt-4 stretched_card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card_title d-flex flex-wrap justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card_title mb-0">Daily Traffic Statistics</h4>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <form>
                                                    <div class="form-group w-80 m-0">
                                                        <select class="form-control form-control-sm">
                                                            <option>Month</option>
                                                            <option>Yesterday</option>
                                                            <option>Today</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-10">
                                        <table class="table table-hover table-center">
                                            <thead>
                                                <tr>
                                                    <td class="w-70">Avatar</td>
                                                    <td class="w-30p">Name</td>
                                                    <td>Order ID</td>
                                                    <td>Sales</td>
                                                    <td>Company</td>
                                                    <td>Date Created</td>
                                                    <td>Rating</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/author/author-img1.jpg" alt="Image" class="img-responsive">
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="fw-600 ">Denis A. Short </div>
                                                    </td>
                                                    <td>547</td>
                                                    <td>100$</td>
                                                    <td>David Co.</td>
                                                    <td>12-06-2019</td>
                                                    <td class="fs-10 text-warning text-nowrap">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/author/author-img4.jpg" alt="Image" class="img-responsive">
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="fw-600 ">Jason A. Short </div>
                                                    </td>
                                                    <td>547</td>
                                                    <td>100$</td>
                                                    <td>David Co.</td>
                                                    <td>12-06-2019</td>
                                                    <td class="fs-10 text-warning text-nowrap">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/author/author-img2.jpg" alt="User" class="img-responsive">
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="fw-600 ">Barbara J.</div>
                                                    </td>
                                                    <td>6435</td>
                                                    <td>8000$</td>
                                                    <td>Market Co.</td>
                                                    <td>21-09-2019</td>
                                                    <td class="fs-10 text-warning text-nowrap">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/author/author-img3.jpg" alt="User" class="img-responsive">
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="fw-600 ">Anthony E. Hurst</div>
                                                    </td>
                                                    <td>4765</td>
                                                    <td>566$</td>
                                                    <td>Querry Enterprise</td>
                                                    <td>14-02-2019</td>
                                                    <td class="fs-10 text-warning text-nowrap">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-md">
                                                            <img src="assets/images/author/author-img4.jpg" alt="User" class="img-responsive">
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="fw-600 ">Wendy B. Franklin</div>
                                                    </td>
                                                    <td>6565</td>
                                                    <td>900$</td>
                                                    <td>Jhon &amp; Sons</td>
                                                    <td>12-06-2019</td>
                                                    <td class="fs-10 text-warning text-nowrap">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 stretched_card mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="card_title">Todo List</h4>
                                        <div>
                                            <i class="mdi mdi-dots-horizontal text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="todo_container">
                                        <div class="todo_content mr-4">
                                            <ul class="d-flex flex-column-reverse todo-list" id="todo_list">
                                                <li><label><input type="checkbox"><i></i><span>Go to Market</span><a href="#" class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked=""><i></i><span>Complete homework.</span><a href="#" class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox"><i></i><span>Make a cup of tea.</span><a href="#" class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked=""><i></i><span>Go out to Play Football</span><a href="#" class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked=""><i></i><span>Complete UI Design</span><a href="#" class="ti-trash"></a></label></li>
                                                <li><label><input type="checkbox" checked=""><i></i><span>Go to Market</span><a href="#" class="ti-trash"></a></label></li>
                                            </ul>
                                        </div>
                                        <div class="list_text">
                                            <input type="text" class="todo_add_item form-control" placeholder="Write new item and hit 'Enter'...">
                                            <button type="button" class="btn btn-primary submit_list_btn">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 mt-4 stretched_card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card_title d-flex flex-wrap justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card_title mb-0">Sales By Country</h4>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <form>
                                                    <div class="form-group w-80 m-0">
                                                        <select class="form-control form-control-sm">
                                                            <option>Today</option>
                                                            <option>Yesterday</option>
                                                            <option>Months</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="sales_country"></div>
                                        <div class="sales_country_labels mt-4">
                                            <div class="single-table">
                                                <div class="table-responsive">
                                                    <table class="table cols-align-middle">
                                                        <tbody>
                                                            <tr>
                                                                <td>Ads</td>
                                                                <td>$3800</td>
                                                                <td>2.2K</td>
                                                                <td><span class="badge badge-primary">2.59</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Affiliates</td>
                                                                <td>$3150</td>
                                                                <td>1.3K</td>
                                                                <td><span class="badge badge-success">2.01</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Yandex</td>
                                                                <td>$1800</td>
                                                                <td>0.5K</td>
                                                                <td><span class="badge badge-danger">1.12</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 stretched_card mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="card_title">Users Activity</h4>
                                        <div>
                                            <i class="mdi mdi-dots-horizontal text-muted"></i>
                                        </div>
                                    </div>
                                    <ul class="bullet-line-list">
                                        <li>
                                            <p class="text-muted mb-2">24 Jan 2019</p>
                                            <p class="mb-2">User Logged in Successfully</p>
                                        </li>
                                        <li>
                                            <p class="text-muted mb-2">25 Mar 2019</p>
                                            <p class="mb-2">Architecto atque cupiditate</p>
                                        </li>
                                        <li>
                                            <p class="text-muted mb-2">26 Aug 2019</p>
                                            <p class="mb-2">Fugit illum laborum minima</p>
                                        </li>
                                        <li>
                                            <p class="text-muted mb-2">27 Nov 2019</p>
                                            <p class="mb-0">Consectetur adipisicing elit</p>
                                        </li>
                                        <li>
                                            <p class="text-muted mb-2">27 Nov 2019</p>
                                            <p class="mb-0">Consectetur adipisicing elit</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Progress Table start -->
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card_title">
                                        Products Table
                                    </h4>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table table-hover progress-table text-center">
                                                <thead class="text-uppercase">
                                                    <tr>
                                                        <th scope="col">Order ID</th>
                                                        <th scope="col">Customer</th>
                                                        <th scope="col">Product</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">status</th>
                                                        <th scope="col">action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">6583</th>
                                                        <td>Mark Spence</td>
                                                        <td>Macbook Pro</td>
                                                        <td>09 / 07 / 2018</td>
                                                        <td>672.56$</td>
                                                        <td><span class="badge badge-primary">Progress</span></td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-inverse-primary"><i class="fa fa-edit"></i></button></li>
                                                                <li><button type="button" class="btn btn-inverse-danger"><i class="ti-trash"></i></button></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">4652</th>
                                                        <td>David Rebon</td>
                                                        <td>iPhone X</td>
                                                        <td>09 / 07 / 2018</td>
                                                        <td>672.56$</td>
                                                        <td><span class="badge badge-warning">Pending</span></td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-inverse-primary"><i class="fa fa-edit"></i></button></li>
                                                                <li><button type="button" class="btn btn-inverse-danger"><i class="ti-trash"></i></button></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">7292</th>
                                                        <td>Jhon Doe</td>
                                                        <td>Samsung</td>
                                                        <td>09 / 07 / 2018</td>
                                                        <td>672.56$</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-inverse-primary"><i class="fa fa-edit"></i></button></li>
                                                                <li><button type="button" class="btn btn-inverse-danger"><i class="ti-trash"></i></button></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">7826</th>
                                                        <td>Jessica Roy</td>
                                                        <td>Exercise Machine</td>
                                                        <td>09 / 07 / 2018</td>
                                                        <td>672.56$</td>
                                                        <td><span class="badge badge-danger">Stopped</span></td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-inverse-primary"><i class="fa fa-edit"></i></button></li>
                                                                <li><button type="button" class="btn btn-inverse-danger"><i class="ti-trash"></i></button></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2638</th>
                                                        <td>Malika Jhon</td>
                                                        <td>Machine</td>
                                                        <td>09 / 07 / 2018</td>
                                                        <td>483.56$</td>
                                                        <td><span class="badge badge-primary">Progress</span></td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-inverse-primary"><i class="fa fa-edit"></i></button></li>
                                                                <li><button type="button" class="btn btn-inverse-danger"><i class="ti-trash"></i></button></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">9374</th>
                                                        <td>David Jess</td>
                                                        <td>Laptop</td>
                                                        <td>09 / 07 / 2018</td>
                                                        <td>473.56$</td>
                                                        <td><span class="badge badge-success">Completed</span></td>
                                                        <td>
                                                            <ul class="d-flex justify-content-center">
                                                                <li class="mr-3"><button type="button" class="btn btn-inverse-primary"><i class="fa fa-edit"></i></button></li>
                                                                <li><button type="button" class="btn btn-inverse-danger"><i class="ti-trash"></i></button></li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Progress Table end -->
                    </div>

                </div>
        <!--==================================*
                   End Main Section
                   *====================================-->
               </div>
    <!--=================================*
           End Main Content Section
           *===================================-->

    <!--=================================*
                  Footer Section
                  *===================================-->
                  <footer>
                  @include('logics.include.footer')

                </footer>
    <!--=================================*
                End Footer Section
                *===================================-->

            </div>
<!--=========================*
        End Page Container
        *===========================-->


<!--=========================*
            Scripts
            *===========================-->

          

        </body>
        </html>
