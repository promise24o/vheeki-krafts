<main id="content" class="wrapper layout-page">
	<section>
		<div class="bg-body-secondary py-5">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
					<li class="breadcrumb-item"><a class="text-decoration-none text-body" href="<?= base_url() ?>">Home</a></li>
					<li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Reviews</li>
				</ol>
			</nav>
		</div>
		<div class="container">
			<div class="text-center pt-13 mb-13 mb-lg-15">
				<div class="text-center">
					<h2 class="fs-36px mb-7">Customer Reviews</h2>
					<p class="fs-18px mb-0 w-lg-60 w-xl-50 mx-md-13 mx-lg-auto">Discover what our customers are saying about their experience with Vheeki Krafts. Read genuine testimonials from art lovers who have transformed their spaces with our unique handcrafted pieces.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="pt-14 pt-lg-18 mt-3">
		<div class="container container-xxl">
			<!-- Reviews Statistics -->
			<div class="row mb-12">
				<div class="col-lg-4">
					<div class="text-center">
						<h2 class="display-4 fw-bold text-primary mb-3"><?= $average_rating ?></h2>
						<div class="mb-3">
							<?php for ($i = 1; $i <= 5; $i++): ?>
								<?php if ($i <= floor($average_rating)): ?>
									<i class="fas fa-star text-warning"></i>
								<?php elseif ($i == ceil($average_rating) && $average_rating < $i): ?>
									<i class="fas fa-star-half-alt text-warning"></i>
								<?php else: ?>
									<i class="far fa-star text-warning"></i>
								<?php endif; ?>
							<?php endfor; ?>
						</div>
						<p class="text-muted"><?= $total_reviews ?> Reviews</p>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="mb-4">
						<h3>Customer Reviews</h3>
					</div>
				</div>
			</div>

			<!-- Reviews List -->
			<div class="row">
				<?php if (!empty($reviews)): ?>
					<?php foreach ($reviews as $review): ?>
						<div class="col-lg-6 mb-8">
							<div class="card border-0 shadow-sm h-100">
								<div class="card-body p-6">
									<!-- Author Info -->
									<div class="d-flex align-items-center mb-4">
										<div class="me-3">
											<?php if (!empty($review['author_image'])): ?>
												<img src="<?= base_url($review['author_image']) ?>" alt="<?= htmlspecialchars($review['author_name']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
											<?php else: ?>
												<div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
													<span class="fw-bold"><?= strtoupper(substr($review['author_name'], 0, 1)) ?></span>
												</div>
											<?php endif; ?>
										</div>
										<div>
											<h6 class="mb-0 fw-semibold"><?= htmlspecialchars($review['author_name']) ?></h6>
											<small class="text-muted"><?= date('M d, Y', strtotime($review['created_at'])) ?></small>
										</div>
									</div>
									
									<!-- Testimonial Content -->
									<div class="mb-4">
										<p class="mb-0 fst-italic">"<?= htmlspecialchars($review['testimonial_text']) ?>"</p>
									</div>
									
									<!-- Rating Stars (Fixed 5 stars for testimonials) -->
									<div class="d-flex align-items-center">
										<div class="me-3">
											<?php for ($i = 1; $i <= 5; $i++): ?>
												<i class="fas fa-star text-warning"></i>
											<?php endfor; ?>
										</div>
										<small class="text-muted">Verified Customer</small>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12 text-center py-12">
						<i class="fas fa-quote-left fa-3x text-muted mb-4"></i>
						<h4 class="text-muted mb-3">No Testimonials Yet</h4>
						<p class="text-muted">Be the first to share your experience with Vheeki Krafts!</p>
						<a href="<?= base_url('shop') ?>" class="btn btn-primary mt-3">Browse Products</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
