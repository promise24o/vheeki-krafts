<main id="content" class="wrapper layout-page">
		<section >
    
	<div class="bg-body-secondary py-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
				<li class="breadcrumb-item"><a class="text-decoration-none text-body" href="<?= base_url() ?>">Home</a></li>
				<li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">Contact Us</li>
			</ol>
		</nav>
	</div>
	<div class="container">
       <div class="text-center pt-13 mb-13 mb-lg-15">
           <div class="text-center">
			   <h2 class="fs-36px mb-7">Keep In Touch with Us</h2>
			   <!-- <p class="fs-18px mb-0 w-lg-60 w-xl-50 mx-md-13 mx-lg-auto">
				   <?= isset($settings['about_us_text']) && !empty($settings['about_us_text']) 
					   ? htmlspecialchars($settings['about_us_text']) 
					   : 'We\'d love to hear from you! Whether you have questions about our handcrafted products or need assistance, feel free to reach out.' ?>
			   </p> -->
		   </div>
	   </div>
	</div>
</section>
<section class="py-15 py-lg-18">
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<h2 class="mb-11 fs-3">Send A Message</h2>
				
				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<i class="bi bi-check-circle me-2"></i><?= $this->session->flashdata('success') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="bi bi-exclamation-triangle me-2"></i><?= $this->session->flashdata('error') ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<?php if (isset($error)): ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<i class="bi bi-exclamation-triangle me-2"></i><?= $error ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

                <form class="contact-form" method="post" action="<?= base_url('contact') ?>">
					<div class="row mb-8 mb-md-10">
						<div class="col-md-6 col-12 mb-8 mb-md-0">
							<input type="text" name="name" class="form-control input-focus" placeholder="Your Name *" 
								   value="<?= set_value('name') ?>" required>
						</div>
						<div class="col-md-6 col-12">
							<input type="email" name="email" class="form-control input-focus" placeholder="Your Email *" 
								   value="<?= set_value('email') ?>" required>
						</div>
					</div>
					<div class="mb-8">
						<input type="text" name="subject" class="form-control input-focus" placeholder="Subject (Optional)" 
							   value="<?= set_value('subject') ?>">
					</div>
					<textarea name="message" class="form-control mb-6 input-focus" placeholder="Your Message *" 
							  rows="7" required><?= set_value('message') ?></textarea>
					<button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11">
						<i class="bi bi-send me-2"></i>Send Message
					</button>
				</form>

			</div>
			<div class="col-lg-5 ps-lg-18 ps-xl-21 mt-13 mt-lg-0">
                <div class="d-flex align-items-start mb-11 me-15">
	<div class="d-none">
		<svg class="icon fs-2">
			<use xlink:href="#"></use>
		</svg>
	</div>
	<div>
			<h3 class="fs-5 mb-6">Address</h3>
			<div class="fs-6">
				<?php if (isset($settings['contact_address']) && !empty($settings['contact_address'])): ?>
					<p class="mb-5 fs-6"><?= nl2br(htmlspecialchars($settings['contact_address'])) ?></p>
				<?php else: ?>
					<p class="mb-5 fs-6">Address not available</p>
				<?php endif; ?>
			</div>
			<?php if (isset($settings['contact_directions_link']) && !empty($settings['contact_directions_link'])): ?>
				<a href="<?= htmlspecialchars($settings['contact_directions_link']) ?>" target="_blank" class="text-decoration-none border-bottom border-currentColor fw-semibold fs-6">Get Direction</a>
			<?php endif; ?>
		</div>
</div>

                <div class="d-flex align-items-start mb-11">
	<div class="d-none">
		<svg class="icon fs-2">
			<use xlink:href="#"></use>
		</svg>
	</div>
	<div>
			<h3 class="fs-5 mb-6">Contact</h3>
			<div class="fs-6">
				<?php if (isset($settings['contact_mobile']) && !empty($settings['contact_mobile'])): ?>
					<p class="mb-3 fs-6">Mobile: <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $settings['contact_mobile'])) ?>" class="text-body-emphasis text-decoration-none"><?= htmlspecialchars($settings['contact_mobile']) ?></a></p>
				<?php endif; ?>
				<?php if (isset($settings['contact_hotline']) && !empty($settings['contact_hotline'])): ?>
					<p class="mb-3 fs-6">Hotline: <a href="tel:<?= htmlspecialchars(str_replace(' ', '', $settings['contact_hotline'])) ?>" class="text-body-emphasis text-decoration-none"><?= htmlspecialchars($settings['contact_hotline']) ?></a></p>
				<?php endif; ?>
				<?php if (isset($settings['contact_email']) && !empty($settings['contact_email'])): ?>
					<p class="mb-3 fs-6">E-mail: <a href="mailto:<?= htmlspecialchars($settings['contact_email']) ?>" class="text-body-emphasis text-decoration-none"><?= htmlspecialchars($settings['contact_email']) ?></a></p>
				<?php endif; ?>
				<?php if (isset($settings['whatsapp_number']) && !empty($settings['whatsapp_number'])): ?>
					<p class="mb-0 fs-6">WhatsApp: <a href="https://wa.me/<?= htmlspecialchars($settings['whatsapp_number']) ?>" target="_blank" class="text-body-emphasis text-decoration-none"><?= htmlspecialchars($settings['whatsapp_number']) ?></a></p>
				<?php endif; ?>
			</div>
		</div>
</div>

				<?php if (isset($settings['business_hours']) && !empty($settings['business_hours'])): ?>
                <div class="d-flex align-items-start">
					<div class="d-none">
						<svg class="icon fs-2">
							<use xlink:href="#"></use>
						</svg>
					</div>
					<div>
						<h3 class="fs-5 mb-6">Business Hours</h3>
						<div class="fs-6">
							<p class="mb-0 fs-6"><?= nl2br(htmlspecialchars($settings['business_hours'])) ?></p>
						</div>
					</div>
				</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>

	</main>