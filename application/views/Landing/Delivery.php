<main id="content" class="wrapper layout-page">
    <section class="z-index-2 position-relative pb-2 mb-12">
        <div class="bg-body-secondary mb-3">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb px-0 py-8">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Delivery Information</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="container pb-14 pb-lg-19">
        <div class="text-center">
            <h2 class="mb-12">Delivery Information</h2>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-6 p-lg-10">
                        
                        <h4 class="mb-6">Shipping & Delivery</h4>
                        
                        <div class="mb-8">
                            <h5 class="mb-4">Delivery Areas</h5>
                            <p class="mb-4">We currently deliver to the following locations:</p>
                            <ul class="mb-0">
                                <li class="mb-3"><strong>Port Harcourt (Primary Location)</strong> and other parts of Rivers State</li>
                                <li class="mb-3">Lagos State and surrounding areas</li>
                                <li class="mb-3">Abuja (FCT)</li>
                                <li class="mb-3">Other major cities in Nigeria (contact us for availability)</li>
                            </ul>
                        </div>

                        <div class="mb-8">
                            <h5 class="mb-4">Delivery Timeline</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Location</th>
                                            <th>Estimated Delivery Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Within Port Harcourt</strong></td>
                                            <td>1-2 business days</td>
                                        </tr>
                                        <tr>
                                            <td>Within Rivers State (Outside PH)</td>
                                            <td>2-3 business days</td>
                                        </tr>
                                        <tr>
                                            <td>Other Major Cities (Lagos, Abuja, etc.)</td>
                                            <td>3-5 business days</td>
                                        </tr>
                                        <tr>
                                            <td>Remote Areas</td>
                                            <td>5-7 business days</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-muted small mt-3">
                                <i class="bi bi-info-circle me-2"></i>
                                Delivery times are estimates and may vary depending on your location and order volume.
                            </p>
                        </div>

                        <div class="mb-8">
                            <h5 class="mb-4">Shipping Costs</h5>
                            <p class="mb-4">Shipping costs are calculated based on:</p>
                            <ul class="mb-4">
                                <li class="mb-3">Delivery location</li>
                                <li class="mb-3">Package size and weight</li>
                                <li class="mb-3">Order value</li>
                            </ul>
                            <div class="alert alert-info">
                                <i class="bi bi-gift me-2"></i>
                                <strong>Free Shipping:</strong> Enjoy free delivery on orders above ₦30,000 within Port Harcourt!
                            </div>
                        </div>

                        <div class="mb-8">
                            <h5 class="mb-4">Order Tracking</h5>
                            <p class="mb-4">Track your order status in real-time:</p>
                            <ol class="mb-4">
                                <li class="mb-3">After placing your order, you'll receive a confirmation email with your order number</li>
                                <li class="mb-3">Visit our <a href="<?= base_url('track-order') ?>" class="text-primary">Order Tracking page</a></li>
                                <li class="mb-3">Enter your order number or tracking number</li>
                                <li class="mb-3">View real-time updates on your delivery status</li>
                            </ol>
                        </div>

                        <div class="mb-8">
                            <h5 class="mb-4">Packaging</h5>
                            <p class="mb-0">
                                All artworks and crafts are carefully packaged to ensure they arrive in perfect condition. 
                                We use protective materials including bubble wrap, foam padding, and sturdy boxes to safeguard 
                                your items during transit.
                            </p>
                        </div>

                        <div class="mb-8">
                            <h5 class="mb-4">Delivery Process</h5>
                            <div class="row g-4">
                                <div class="col-md-3 text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-cart-check fs-1 text-primary"></i>
                                    </div>
                                    <h6>Order Placed</h6>
                                    <p class="small text-muted">You place your order and make payment</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-box-seam fs-1 text-primary"></i>
                                    </div>
                                    <h6>Processing</h6>
                                    <p class="small text-muted">We carefully package your items</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-truck fs-1 text-primary"></i>
                                    </div>
                                    <h6>Shipped</h6>
                                    <p class="small text-muted">Your order is on its way</p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-house fs-1 text-primary"></i>
                                    </div>
                                    <h6>Delivered</h6>
                                    <p class="small text-muted">Package arrives at your doorstep</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h5 class="mb-4">Failed Delivery Attempts</h5>
                            <p class="mb-3">If delivery fails due to:</p>
                            <ul class="mb-4">
                                <li class="mb-2">Incorrect address</li>
                                <li class="mb-2">Recipient unavailable</li>
                                <li class="mb-2">Refused delivery</li>
                            </ul>
                            <p class="mb-0">
                                Our courier will contact you to reschedule. Additional delivery charges may apply for 
                                re-delivery attempts.
                            </p>
                        </div>

                        <div class="mb-0">
                            <h5 class="mb-4">Contact Us</h5>
                            <p class="mb-4">For delivery inquiries or special requests:</p>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-envelope fs-4 text-primary me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Email</h6>
                                            <a href="mailto:delivery@vheekikrafts.com" class="text-body">delivery@vheekikrafts.com</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-telephone fs-4 text-primary me-3"></i>
                                        <div>
                                            <h6 class="mb-1">Phone</h6>
                                            <a href="tel:+2348030001111" class="text-body">+234 803 000 1111</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
