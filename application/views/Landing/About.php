<main id="content" class="wrapper layout-page">
    <section class="pb-14 py-lg-18">
        <div class="container container-xxl">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-0 hover-zoom-in">
                        <div class="image-box-4">
                            <img class="lazy-image img-fluid lazy-image" src="#" data-src="<?= base_url() ?>assets/landing/images/others/about-cover.jpg" width="960" height="640" alt="Vheeki Krafts Artwork">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 px-xxl-18 mt-12 mt-lg-0">
                    <h2 class="mb-8">About Vheeki Krafts</h2>
                    <?php if (isset($settings['about_us_text']) && !empty($settings['about_us_text'])): ?>
                        <p class="mb-8"><?= nl2br(htmlspecialchars($settings['about_us_text'])) ?></p>
                    <?php else: ?>
                        <p class="mb-8">At Vheeki Krafts, we capture moments and transform them into timeless visual art. Each frame begins as a photograph carefully composed, color-graded, and refined to express emotion and meaning.</p>
                    <?php endif; ?>
                    
                    <p class="mb-xl-16">Our works go beyond simple pictures—they tell stories, reflect moods, and bring character into every space they decorate. We believe art should speak not just to the eyes, but to the soul. That's why every piece we create is <span class="text-body-emphasis">crafted with detail, creativity, and passion</span>, ensuring it connects deeply with those who see it.</p>
                    
                    <div class="row">
                        <?php if (isset($settings['contact_mobile']) && !empty($settings['contact_mobile'])): ?>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="d-none">
                                    <svg class="icon fs-2">
                                        <use xlink:href="#"></use>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="fs-5 mb-6">Contact Us</h3>
                                    <div class="fs-6">
                                        <p class="mb-6 fs-15px">Reach out to us for inquiries about our artwork and custom pieces.</p>
                                        <p class="m-0 fs-6 fw-bold text-primary">
                                            <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $settings['contact_mobile'])) ?>" class="text-decoration-none text-primary">
                                                <?= htmlspecialchars($settings['contact_mobile']) ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (isset($settings['business_hours']) && !empty($settings['business_hours'])): ?>
                        <div class="col-md-6 pt-9 pt-md-0">
                            <div class="d-flex align-items-start">
                                <div class="d-none">
                                    <svg class="icon fs-2">
                                        <use xlink:href="#"></use>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="fs-5 mb-6">Business Hours</h3>
                                    <div class="fs-6">
                                        <?= nl2br(htmlspecialchars($settings['business_hours'])) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container container-xxl mb-11">
            <div class="text-center pb-11 pb-lg-14">
                <h2 class="fs-3 w-lg-40 w-auto mx-auto pb-7">Transforming Moments into Timeless Art</h2>
                <p class="mw-lg-50 mx-auto">Whether you're decorating a home, office, or gallery, our goal is to inspire and remind you that beauty lives in every captured moment. Each piece is designed to evoke emotion and add character to your space.</p>
            </div>
            <div class="row gy-30px">
                <div class="col-md-4">
                    <div class="">
                        <!-- <div class="d-flex justify-content-center">
                            <img class="lazy-image img-fluid light-mode-img" src="#" data-src="<?= base_url() ?>assets/landing/images/image-box/image-box-11.png" width="102" height="118" alt="Carefully Composed">
                            <img class="lazy-image dark-mode-img img-fluid" src="#" data-src="<?= base_url() ?>assets/landing/images/image-box/image-box-white-11.png" width="102" height="118" alt="Carefully Composed">
                        </div> -->
                        <div class="card-body text-center pt-7 mt-3">
                            <h3 class="fs-4 mb-6">Carefully Composed</h3>
                            <p class="mb-0 px-lg-6">Every photograph is meticulously framed and composed to capture the perfect balance of light, color, and emotion</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <!-- <div class="d-flex justify-content-center">
                            <img class="lazy-image img-fluid light-mode-img" src="#" data-src="<?= base_url() ?>assets/landing/images/image-box/image-box-02.png" width="102" height="118" alt="Expertly Color-Graded">
                            <img class="lazy-image dark-mode-img img-fluid" src="#" data-src="<?= base_url() ?>assets/landing/images/image-box/image-box-white-02.png" width="102" height="118" alt="Expertly Color-Graded">
                        </div> -->
                        <div class="card-body text-center pt-7 mt-3">
                            <h3 class="fs-4 mb-6">Expertly Color-Graded</h3>
                            <p class="mb-0 px-lg-6">Each image is refined with professional color grading to enhance mood, depth, and visual storytelling</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <!-- <div class="d-flex justify-content-center">
                            <img class="lazy-image img-fluid light-mode-img" src="#" data-src="<?= base_url() ?>assets/landing/images/image-box/image-box-03.png" width="102" height="118" alt="Crafted with Passion">
                            <img class="lazy-image dark-mode-img img-fluid" src="#" data-src="<?= base_url() ?>assets/landing/images/image-box/image-box-white-03.png" width="102" height="118" alt="Crafted with Passion">
                        </div> -->
                        <div class="card-body text-center pt-7 mt-3">
                            <h3 class="fs-4 mb-6">Crafted with Passion</h3>
                            <p class="mb-0 px-lg-6">Every piece is created with attention to detail, creativity, and a passion for visual storytelling that speaks to the soul</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>