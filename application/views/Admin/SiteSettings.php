<div class="body-wrapper">
<div class="body-wrapper-inner">
  <div class="container-fluid">
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
      <div class="card-body px-4 py-3">
        <div class="row align-items-center">
          <div class="col-9">
            <h4 class="fw-semibold mb-8">Site Settings</h4>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted text-decoration-none" href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
              </ol>
            </nav>
          </div>
          <div class="col-3">
            <div class="text-center mb-n5">
              <img src="<?= base_url() ?>assets/admin/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="ti ti-check me-2"></i><?= $this->session->flashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="ti ti-alert-circle me-2"></i><?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-body">
        <ul class="nav nav-pills mb-4" id="settingsTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button" role="tab">
              <i class="ti ti-phone me-2"></i>Contact Info
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button" role="tab">
              <i class="ti ti-share me-2"></i>Social Media
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="homepage-tab" data-bs-toggle="pill" data-bs-target="#homepage" type="button" role="tab">
              <i class="ti ti-home me-2"></i>Homepage
            </button>
          </li>
        </ul>

        <form method="post" enctype="multipart/form-data">
          <div class="tab-content" id="settingsTabContent">
            
            <!-- Contact Info Tab -->
            <div class="tab-pane fade show active" id="contact" role="tabpanel">
              <h5 class="mb-4">Contact Information</h5>
              
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label class="form-label">Contact Email</label>
                  <input type="email" class="form-control" name="settings[contact_email]" 
                         value="<?= isset($settings['contact_email']) ? htmlspecialchars($settings['contact_email']) : '' ?>" 
                         placeholder="info@vheekikrafts.com">
                  <small class="text-muted">Main contact email</small>
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label">Contact Mobile</label>
                  <input type="text" class="form-control" name="settings[contact_mobile]" 
                         value="<?= isset($settings['contact_mobile']) ? htmlspecialchars($settings['contact_mobile']) : '' ?>" 
                         placeholder="+1 (555) 123-4567">
                  <small class="text-muted">Primary phone number</small>
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label">Contact Hotline</label>
                  <input type="text" class="form-control" name="settings[contact_hotline]" 
                         value="<?= isset($settings['contact_hotline']) ? htmlspecialchars($settings['contact_hotline']) : '' ?>" 
                         placeholder="+1 (555) 987-6543">
                  <small class="text-muted">Secondary/support phone</small>
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label">WhatsApp Number</label>
                  <input type="text" class="form-control" name="settings[whatsapp_number]" 
                         value="<?= isset($settings['whatsapp_number']) ? htmlspecialchars($settings['whatsapp_number']) : '' ?>" 
                         placeholder="+1234567890">
                  <small class="text-muted">WhatsApp contact (with country code, no spaces)</small>
                </div>

                <div class="col-12 mb-4">
                  <label class="form-label">Business Address</label>
                  <textarea class="form-control" name="settings[contact_address]" rows="3" 
                            placeholder="123 Art Street&#10;Creative District&#10;City, State 12345"><?= isset($settings['contact_address']) ? htmlspecialchars($settings['contact_address']) : '' ?></textarea>
                  <small class="text-muted">Full business address</small>
                </div>

                <div class="col-12 mb-4">
                  <label class="form-label">Google Maps Link</label>
                  <input type="url" class="form-control" name="settings[contact_directions_link]" 
                         value="<?= isset($settings['contact_directions_link']) ? htmlspecialchars($settings['contact_directions_link']) : '' ?>" 
                         placeholder="https://maps.google.com/?q=Your+Address">
                  <small class="text-muted">Link to your location on Google Maps</small>
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label">Business Hours</label>
                  <textarea class="form-control" name="settings[business_hours]" rows="3" 
                            placeholder="Mon-Fri: 9:00 AM - 6:00 PM&#10;Sat: 10:00 AM - 4:00 PM&#10;Sun: Closed"><?= isset($settings['business_hours']) ? htmlspecialchars($settings['business_hours']) : '' ?></textarea>
                  <small class="text-muted">Operating hours</small>
                </div>
              </div>
            </div>

            <!-- Social Media Tab -->
            <div class="tab-pane fade" id="social" role="tabpanel">
              <h5 class="mb-4">Social Media Links</h5>
              
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-facebook me-2"></i>Facebook URL</label>
                  <input type="url" class="form-control" name="settings[facebook_url]" 
                         value="<?= isset($settings['facebook_url']) ? htmlspecialchars($settings['facebook_url']) : '' ?>" 
                         placeholder="https://facebook.com/vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-instagram me-2"></i>Instagram URL</label>
                  <input type="url" class="form-control" name="settings[instagram_url]" 
                         value="<?= isset($settings['instagram_url']) ? htmlspecialchars($settings['instagram_url']) : '' ?>" 
                         placeholder="https://instagram.com/vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-twitter me-2"></i>Twitter/X URL</label>
                  <input type="url" class="form-control" name="settings[twitter_url]" 
                         value="<?= isset($settings['twitter_url']) ? htmlspecialchars($settings['twitter_url']) : '' ?>" 
                         placeholder="https://twitter.com/vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-linkedin me-2"></i>LinkedIn URL</label>
                  <input type="url" class="form-control" name="settings[linkedin_url]" 
                         value="<?= isset($settings['linkedin_url']) ? htmlspecialchars($settings['linkedin_url']) : '' ?>" 
                         placeholder="https://linkedin.com/company/vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-youtube me-2"></i>YouTube URL</label>
                  <input type="url" class="form-control" name="settings[youtube_url]" 
                         value="<?= isset($settings['youtube_url']) ? htmlspecialchars($settings['youtube_url']) : '' ?>" 
                         placeholder="https://youtube.com/@vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-pinterest me-2"></i>Pinterest URL</label>
                  <input type="url" class="form-control" name="settings[pinterest_url]" 
                         value="<?= isset($settings['pinterest_url']) ? htmlspecialchars($settings['pinterest_url']) : '' ?>" 
                         placeholder="https://pinterest.com/vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-tiktok me-2"></i>TikTok URL</label>
                  <input type="url" class="form-control" name="settings[tiktok_url]" 
                         value="<?= isset($settings['tiktok_url']) ? htmlspecialchars($settings['tiktok_url']) : '' ?>" 
                         placeholder="https://tiktok.com/@vheekikrafts">
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label"><i class="ti ti-brand-whatsapp me-2"></i>WhatsApp Business URL</label>
                  <input type="url" class="form-control" name="settings[whatsapp_url]" 
                         value="<?= isset($settings['whatsapp_url']) ? htmlspecialchars($settings['whatsapp_url']) : '' ?>" 
                         placeholder="https://wa.me/1234567890">
                </div>
              </div>
            </div>

            <!-- Homepage Tab -->
            <div class="tab-pane fade" id="homepage" role="tabpanel">
              <h5 class="mb-4">Homepage Settings</h5>
              
              <div class="row">
                <div class="col-12 mb-4">
                  <label class="form-label">Announcement Bar Text</label>
                  <input type="text" class="form-control" name="settings[announcement_text]" 
                         value="<?= isset($settings['announcement_text']) ? htmlspecialchars($settings['announcement_text']) : '' ?>" 
                         placeholder="Free Delivery on all orders above ₦50,000">
                  <small class="text-muted">Text displayed in the top announcement bar (leave empty to use default)</small>
                </div>

                <div class="col-md-6 mb-4">
                  <label class="form-label">Products Per Page</label>
                  <input type="number" class="form-control" name="settings[products_per_page]" 
                         value="<?= isset($settings['products_per_page']) ? $settings['products_per_page'] : '12' ?>" 
                         min="6" max="100">
                  <small class="text-muted">Number of products to show per page in shop</small>
                </div>

                <div class="col-12 mb-4">
                  <label class="form-label">About Us Text</label>
                  <textarea class="form-control" name="settings[about_us_text]" rows="5" 
                            placeholder="Tell your story..."><?= isset($settings['about_us_text']) ? htmlspecialchars($settings['about_us_text']) : '' ?></textarea>
                  <small class="text-muted">Brief about section displayed in footer and about page</small>
                </div>
              </div>
            </div>

          </div>

          <div class="border-top pt-4 mt-4">
            <button type="submit" class="btn btn-primary">
              <i class="ti ti-device-floppy me-2"></i>Save All Settings
            </button>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-outline-secondary ms-2">
              <i class="ti ti-x me-2"></i>Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script>
// Auto-save indication
document.querySelector('form').addEventListener('submit', function(e) {
  const submitBtn = this.querySelector('button[type="submit"]');
  submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';
  submitBtn.disabled = true;
});

// Image preview
document.querySelectorAll('input[type="file"]').forEach(input => {
  input.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
      const reader = new FileReader();
      const preview = this.previousElementSibling;
      
      reader.onload = function(e) {
        if (preview && preview.tagName === 'DIV') {
          const img = preview.querySelector('img');
          if (img) {
            img.src = e.target.result;
          }
        }
      }
      
      reader.readAsDataURL(this.files[0]);
    }
  });
});
</script>
