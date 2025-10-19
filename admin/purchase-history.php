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
    <title>Admin Panel | Purchase History | New Tech</title>
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
                            <a class="nav-link" href="admin-panel.html">
                                <i class="fas fa-house-chimney"></i>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="purchase-history.html">
                                <i class="fas fa-file"></i>
                                <span class="ml-2">Transactions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="products.html">
                                <i class="fas fa-box"></i>
                                <span class="ml-2">Products</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-users.html">
                                <i class="fas fa-users-between-lines"></i>
                                <span class="ml-2">Customers</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="margin-bottom" style="margin-top: 2rem;"></div>
            <div class="col-12 col-xl-8 mb-4 mb-lg-0" style="margin-left: 14em;">
                <div class="card">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="purchase-history-footer mt-5 d-flex justify-content-center align-items-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">2</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="margin-top mt-5"></div>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
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
                                    <p><i class="fas fa-home me-3 text-secondary"></i> 1000/A, Galle, Colombo, Sri Lanka
                                    </p>
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