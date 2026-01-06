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
					<div class="d-flex justify-content-between align-items-center mb-4">
						<h3>Customer Reviews</h3>
						<a href="<?= base_url('admin/reviews') ?>" class="btn btn-outline-primary btn-sm">
							<i class="fas fa-cog me-2"></i>Manage Reviews
						</a>
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
									<!-- Rating Stars -->
									<div class="d-flex align-items-center mb-4">
										<div class="me-3">
											<?php for ($i = 1; $i <= 5; $i++): ?>
												<?php if ($i <= $review['rating']): ?>
													<i class="fas fa-star text-warning"></i>
												<?php else: ?>
													<i class="far fa-star text-warning"></i>
												<?php endif; ?>
											<?php endfor; ?>
										</div>
										<span class="text-muted"><?= date('M d, Y', strtotime($review['created_at'])) ?></span>
									</div>
									
									<!-- Review Content -->
									<div class="mb-4">
										<?php if (!empty($review['review_title'])): ?>
											<h5 class="mb-2"><?= htmlspecialchars($review['review_title']) ?></h5>
										<?php endif; ?>
										<p class="mb-3"><?= htmlspecialchars($review['review_text']) ?></p>
									</div>
									
									<!-- Reviewer Info -->
									<div class="d-flex align-items-center justify-content-between">
										<div>
											<h6 class="mb-0 fw-semibold"><?= htmlspecialchars($review['customer_name']) ?></h6>
											<small class="text-muted">
												<?php if (isset($review['product_name'])): ?>
													Reviewed: <?= htmlspecialchars($review['product_name']) ?>
												<?php endif; ?>
											</small>
										</div>
										<?php if (!empty($review['reviewer_portfolio'])): ?>
											<a href="<?= htmlspecialchars($review['reviewer_portfolio']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
												<i class="fas fa-external-link-alt me-1"></i>Portfolio
											</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12 text-center py-12">
						<i class="fas fa-star fa-3x text-muted mb-4"></i>
						<h4 class="text-muted mb-3">No Reviews Yet</h4>
						<p class="text-muted">Be the first to share your experience with Vheeki Krafts!</p>
						<a href="<?= base_url('shop') ?>" class="btn btn-primary mt-3">Browse Products</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
