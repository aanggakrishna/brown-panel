@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="display-4 mb-2">🎨 Modern Brown-Orange Theme</h1>
            <p class="lead text-muted">Komponen UI yang dapat digunakan berulang dengan tema coklat-oranye yang elegant</p>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Components</a></li>
            <li class="breadcrumb-item active">Demo</li>
        </ol>
    </nav>

    <!-- Buttons Section -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">🔘 Buttons</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h5 class="mb-3">Button Variants</h5>
                        <button class="btn btn-primary me-2 mb-2">Primary</button>
                        <button class="btn btn-secondary me-2 mb-2">Secondary</button>
                        <button class="btn btn-success me-2 mb-2">Success</button>
                        <button class="btn btn-danger me-2 mb-2">Danger</button>
                        <button class="btn btn-warning me-2 mb-2">Warning</button>
                        <button class="btn btn-info me-2 mb-2">Info</button>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h5 class="mb-3">Outline Buttons</h5>
                        <button class="btn btn-outline-primary me-2 mb-2">Outline Primary</button>
                        <button class="btn btn-outline-secondary me-2 mb-2">Outline Secondary</button>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h5 class="mb-3">Button Sizes</h5>
                        <button class="btn btn-primary btn-sm me-2">Small</button>
                        <button class="btn btn-primary me-2">Default</button>
                        <button class="btn btn-primary btn-lg">Large</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cards Section -->
    <section class="mb-5">
        <div class="row">
            <div class="col-12 mb-3">
                <h2>🃏 Cards</h2>
            </div>

            <!-- Standard Card -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Standard Card</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">This is a standard card with gradient header and hover effect.</p>
                    </div>
                    <div class="card-footer text-muted">
                        Footer content
                    </div>
                </div>
            </div>

            <!-- Elegant Card -->
            <div class="col-md-4 mb-4">
                <div class="card card-elegant">
                    <div class="card-header">
                        <h5 class="mb-0">Elegant Card</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">This card has gradient background with brown-orange header.</p>
                    </div>
                </div>
            </div>

            <!-- Accent Card -->
            <div class="col-md-4 mb-4">
                <div class="card card-accent hover-lift">
                    <div class="card-body">
                        <h5>Accent Card with Hover</h5>
                        <p class="mb-0">Card with left accent border and lift effect on hover.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Cards -->
    <section class="mb-5">
        <div class="row">
            <div class="col-12 mb-3">
                <h2>📊 Statistics Cards</h2>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card hover-lift text-center">
                    <div class="card-body">
                        <h2 class="text-brown-orange mb-2">1,234</h2>
                        <p class="text-muted mb-0">Total Users</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card hover-lift text-center">
                    <div class="card-body">
                        <h2 class="text-success mb-2">567</h2>
                        <p class="text-muted mb-0">Active Projects</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card hover-lift text-center">
                    <div class="card-body">
                        <h2 class="text-warning mb-2">89</h2>
                        <p class="text-muted mb-0">Pending Tasks</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card hover-lift text-center">
                    <div class="card-body">
                        <h2 class="text-danger mb-2">12</h2>
                        <p class="text-muted mb-0">Critical Issues</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Forms Section -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">📝 Forms</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" placeholder="your@email.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country">
                                <option selected>Choose country...</option>
                                <option value="id">Indonesia</option>
                                <option value="my">Malaysia</option>
                                <option value="sg">Singapore</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="3" placeholder="Your message..."></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-2">Submit Form</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tables Section -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">📋 Data Table</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td><span class="badge badge-primary">Admin</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td><span class="badge badge-secondary">User</span></td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bob Wilson</td>
                            <td>bob@example.com</td>
                            <td><span class="badge badge-warning">Moderator</span></td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Badges Section -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">🏷️ Badges</h3>
            </div>
            <div class="card-body">
                <span class="badge badge-primary me-2">Primary</span>
                <span class="badge badge-secondary me-2">Secondary</span>
                <span class="badge badge-success me-2">Success</span>
                <span class="badge badge-danger me-2">Danger</span>
                <span class="badge badge-warning me-2">Warning</span>
            </div>
        </div>
    </section>

    <!-- Alerts Section -->
    <section class="mb-5">
        <div class="row">
            <div class="col-12 mb-3">
                <h2>⚠️ Alerts</h2>
            </div>

            <div class="col-md-6 mb-3">
                <div class="alert alert-primary">
                    <strong>Info!</strong> This is a primary alert with brown-orange theme.
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="alert alert-success">
                    <strong>Success!</strong> Your operation completed successfully.
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="alert alert-warning">
                    <strong>Warning!</strong> Please check your input carefully.
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="alert alert-danger">
                    <strong>Error!</strong> Something went wrong. Please try again.
                </div>
            </div>
        </div>
    </section>

    <!-- Pagination Section -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">📱 Pagination</h3>
            </div>
            <div class="card-body">
                <nav>
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">5</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <!-- Background Utilities Section -->
    <section class="mb-5">
        <div class="row">
            <div class="col-12 mb-3">
                <h2>🎨 Background Utilities</h2>
            </div>

            <div class="col-md-4 mb-3">
                <div class="bg-primary-gradient p-4 rounded text-center">
                    <h5 class="mb-0">Primary Gradient</h5>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="bg-secondary-gradient p-4 rounded text-center">
                    <h5 class="mb-0">Secondary Gradient</h5>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="bg-light-brown p-4 rounded text-center">
                    <h5 class="text-primary-dark mb-0">Light Brown</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Example Button -->
    <section class="mb-5">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">🪟 Modal Example</h3>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                    Launch Demo Modal
                </button>
            </div>
        </div>
    </section>
</div>

<!-- Example Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>This is a modal with brown-orange gradient header!</p>
                <p class="mb-0">You can use this for confirmations, forms, or any other content.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
