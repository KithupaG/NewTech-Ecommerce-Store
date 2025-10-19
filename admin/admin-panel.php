<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="../../js/main.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/main.js" defer></script>
    <link rel="stylesheet" href="../../css/universal.css" />
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Admin Panel | Dashboard | New Tech</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand font-weight-bold" href="#">
                New Tech
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
                data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex align-items-center">
            <a class="d-flex align-items-center hidden-arrow" href="#">
                <img src="../../resources/site/user.jfif" class="rounded-circle" height="40px" width="55px"
                    loading="lazy" />
            </a>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="fas fa-house-chimney"></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchase-history.html">
                                <i class="fas fa-file"></i>
                                <span class="ml-2">Transactions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-box"></i>
                                <span class="ml-2">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users-between-lines"></i>
                                <span class="ml-2">Customers</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Dashboard</h1>
                <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Customers</h5>
                            <div class="card-body">
                                <h5 class="card-title">345k</h5>
                                <p class="card-text">Oct 1 - Dec 22, Sri Lanka</p>
                                <p class="card-text text-success">18.2% increase since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Revenue</h5>
                            <div class="card-body">
                                <h5 class="card-title">Rs.2.4k</h5>
                                <p class="card-text">Nov 1 - Dec 22, Sri Lanka</p>
                                <p class="card-text text-success">4.6% increase since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Purchases</h5>
                            <div class="card-body">
                                <h5 class="card-title">53</h5>
                                <p class="card-text">Dec 22, Sri Lanka</p>
                                <p class="card-text text-success">2.6% increase since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Traffic</h5>
                            <div class="card-body">
                                <h5 class="card-title">64k</h5>
                                <p class="card-text">Nov 1 - Dec 22, Sri Lanka</p>
                                <p class="card-text text-success">2.5% increase since last month</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Purchase History</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Date</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>GSI-2000</td>
                                                <td>somebody@gmail.com</td>
                                                <td>Rs. 700,000</td>
                                                <td>Dec 25 2022</td>
                                                <td><button class="btn btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button></td>
                                                <td><button class="btn btn-danger">
                                                    <i class="fas fa-trash-can"></i>
                                                </button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>Gaming Mouse</td>
                                                <td>somebody@gmail.com</td>
                                                <td>Rs. 1,000</td>
                                                <td>Dec 25 2022</td>
                                                <td><button class="btn btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button></td>
                                                <td><button class="btn btn-danger">
                                                    <i class="fas fa-trash-can"></i>
                                                </button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>Drone 70</td>
                                                <td>somebody@gmail.com</td>
                                                <td>Rs. 40,000</td>
                                                <td>Dec 25 2022</td>
                                                <td><button class="btn btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button></td>
                                                <td><button class="btn btn-danger">
                                                    <i class="fas fa-trash-can"></i>
                                                </button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>Arduino Board</td>
                                                <td>somebody@gmail.com</td>
                                                <td>Rs. 70,000</td>
                                                <td>Dec 25 2022</td>
                                                <td><button class="btn btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button></td>
                                                <td><button class="btn btn-danger">
                                                    <i class="fas fa-trash-can"></i>
                                                </button></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>GSI-2000</td>
                                                <td>somebody@gmail.com</td>
                                                <td>Rs. 700,000</td>
                                                <td>Dec 25 2022</td>
                                                <td><button class="btn btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button></td>
                                                <td><button class="btn btn-danger">
                                                    <i class="fas fa-trash-can"></i>
                                                </button></td>
                                            </tr>
                                            <tr class="mb-5">
                                                <th scope="row">17370540</th>
                                                <td>Gaming Mouse</td>
                                                <td>somebody@gmail.com</td>
                                                <td>Rs. 1,000</td>
                                                <td>Dec 25 2022</td>
                                                <td><button class="btn btn-success">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button></td>
                                                <td><button class="btn btn-danger">
                                                    <i class="fas fa-trash-can"></i>
                                                </button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="purchase-history.html" class="btn btn-outline-success w-100">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <h5 class="card-header">Traffic last 6 months</h5>
                            <div class="card-body">
                                <div id="traffic-chart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct"
                                        width="100%" height="100%" class="ct-chart-line"
                                        style="width: 100%; height: 100%;">
                                        <g class="ct-grids">
                                            <line x1="50" x2="50" y1="15" y2="115" class="ct-grid ct-horizontal"></line>
                                            <line x1="138.83333333333331" x2="138.83333333333331" y1="15" y2="115"
                                                class="ct-grid ct-horizontal"></line>
                                            <line x1="227.66666666666666" x2="227.66666666666666" y1="15" y2="115"
                                                class="ct-grid ct-horizontal"></line>
                                            <line x1="316.5" x2="316.5" y1="15" y2="115" class="ct-grid ct-horizontal">
                                            </line>
                                            <line x1="405.3333333333333" x2="405.3333333333333" y1="15" y2="115"
                                                class="ct-grid ct-horizontal"></line>
                                            <line x1="494.16666666666663" x2="494.16666666666663" y1="15" y2="115"
                                                class="ct-grid ct-horizontal"></line>
                                            <line y1="115" y2="115" x1="50" x2="583" class="ct-grid ct-vertical"></line>
                                            <line y1="86.42857142857143" y2="86.42857142857143" x1="50" x2="583"
                                                class="ct-grid ct-vertical"></line>
                                            <line y1="57.857142857142854" y2="57.857142857142854" x1="50" x2="583"
                                                class="ct-grid ct-vertical"></line>
                                            <line y1="29.285714285714292" y2="29.285714285714292" x1="50" x2="583"
                                                class="ct-grid ct-vertical"></line>
                                        </g>
                                        <g>
                                            <g class="ct-series ct-series-a">
                                                <path
                                                    d="M50,115L50,82.143C79.611,81.19,109.222,79.286,138.833,79.286C168.444,79.286,198.056,87.857,227.667,87.857C257.278,87.857,286.889,74.923,316.5,66.429C346.111,57.934,375.722,40.587,405.333,35C434.944,29.413,464.556,27.381,494.167,23.571L494.167,115Z"
                                                    class="ct-area"></path>
                                                <path
                                                    d="M50,82.143C79.611,81.19,109.222,79.286,138.833,79.286C168.444,79.286,198.056,87.857,227.667,87.857C257.278,87.857,286.889,74.923,316.5,66.429C346.111,57.934,375.722,40.587,405.333,35C434.944,29.413,464.556,27.381,494.167,23.571"
                                                    class="ct-line"></path>
                                                <line x1="50" y1="82.14285714285714" x2="50.01" y2="82.14285714285714"
                                                    class="ct-point" ct:value="23000"></line>
                                                <line x1="138.83333333333331" y1="79.28571428571428"
                                                    x2="138.8433333333333" y2="79.28571428571428" class="ct-point"
                                                    ct:value="25000"></line>
                                                <line x1="227.66666666666666" y1="87.85714285714286"
                                                    x2="227.67666666666665" y2="87.85714285714286" class="ct-point"
                                                    ct:value="19000"></line>
                                                <line x1="316.5" y1="66.42857142857143" x2="316.51"
                                                    y2="66.42857142857143" class="ct-point" ct:value="34000"></line>
                                                <line x1="405.3333333333333" y1="35" x2="405.3433333333333" y2="35"
                                                    class="ct-point" ct:value="56000"></line>
                                                <line x1="494.16666666666663" y1="23.57142857142857"
                                                    x2="494.1766666666666" y2="23.57142857142857" class="ct-point"
                                                    ct:value="64000"></line>
                                            </g>
                                        </g>
                                        <g class="ct-labels">
                                            <foreignObject style="overflow: visible;" x="50" y="120"
                                                width="88.83333333333333" height="20"><span
                                                    class="ct-label ct-horizontal ct-end"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="width: 89px; height: 20px;">January</span></foreignObject>
                                            <foreignObject style="overflow: visible;" x="138.83333333333331" y="120"
                                                width="88.83333333333333" height="20"><span
                                                    class="ct-label ct-horizontal ct-end"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="width: 89px; height: 20px;">Februrary</span></foreignObject>
                                            <foreignObject style="overflow: visible;" x="227.66666666666666" y="120"
                                                width="88.83333333333334" height="20"><span
                                                    class="ct-label ct-horizontal ct-end"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="width: 89px; height: 20px;">March</span></foreignObject>
                                            <foreignObject style="overflow: visible;" x="316.5" y="120"
                                                width="88.83333333333331" height="20"><span
                                                    class="ct-label ct-horizontal ct-end"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="width: 89px; height: 20px;">April</span></foreignObject>
                                            <foreignObject style="overflow: visible;" x="405.3333333333333" y="120"
                                                width="88.83333333333331" height="20"><span
                                                    class="ct-label ct-horizontal ct-end"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="width: 89px; height: 20px;">May</span></foreignObject>
                                            <foreignObject style="overflow: visible;" x="494.16666666666663" y="120"
                                                width="88.83333333333337" height="20"><span
                                                    class="ct-label ct-horizontal ct-end"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="width: 89px; height: 20px;">June</span></foreignObject>
                                            <foreignObject style="overflow: visible;" y="86.42857142857143" x="10"
                                                height="28.571428571428573" width="30"><span
                                                    class="ct-label ct-vertical ct-start"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="height: 29px; width: 30px;">0</span></foreignObject>
                                            <foreignObject style="overflow: visible;" y="57.85714285714286" x="10"
                                                height="28.571428571428573" width="30"><span
                                                    class="ct-label ct-vertical ct-start"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="height: 29px; width: 30px;">20000</span></foreignObject>
                                            <foreignObject style="overflow: visible;" y="29.285714285714292" x="10"
                                                height="28.571428571428562" width="30"><span
                                                    class="ct-label ct-vertical ct-start"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="height: 29px; width: 30px;">40000</span></foreignObject>
                                            <foreignObject style="overflow: visible;" y="-0.7142857142857082" x="10"
                                                height="30" width="30"><span class="ct-label ct-vertical ct-start"
                                                    xmlns="http://www.w3.org/2000/xmlns/"
                                                    style="height: 30px; width: 30px;">60000</span></foreignObject>
                                        </g>
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="margin-top mt-5"></div>
                <footer class="text-center text-lg-start bg-dark text-muted">
                    <section class="d-flex justify-content-center justify-content-lg-between p-4">
                    </section>
                    <section>
                        <div class="container text-center text-md-start mt-5">
                            <div class="row mt-3">
                                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        <i class="fab fa-accusoft me-3 text-secondary"></i>New Tech
                                    </h6>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere, voluptatum.
                                    </p>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                                    <h6 class="text-uppercase fw-bold mb-4">
                                        Useful links
                                    </h6>
                                    <p>
                                        <a href="store.html" class="text-reset">Store</a>
                                    </p>
                                    <p>
                                        <a href="#contact" class="text-reset">Contact</a>
                                    </p>
                                    <p>
                                        <a href="#about" class="text-reset">About</a>
                                    </p>
                                </div>
                                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                                    <p><i class="fas fa-home me-3 text-secondary"></i> 1000/A, Galle, Colombo, Sri Lanka</p>
                                    <p>
                                        <i class="fa-solid fa-envelope me3 text-secondary"></i>
                                        newtech@newtech.com
                                    </p>
                                    <p><i class="fa-solid fa-phone me-3 text-secondary"></i> +94 234 567 88</p>
                                    <p><i class="fa-solid fa-print me-3 text-secondary"></i> + 94 234 567 89</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
                        © 2022 Copyright:
                        <a class="text-reset fw-bold" href="../../main.html">NewTech.com</a>
                    </div>
                </footer>
            </main>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

</html>