<div class="body-wrapper">
<div class="body-wrapper-inner">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                  <h5 class="card-title fw-semibold mb-1">Add New Product</h5>
                  <p class="mb-0 text-muted">Create a new product for your store</p>
                </div>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-outline-secondary">
                  <i class="ti ti-arrow-left me-2"></i>Back to Products
                </a>
              </div>

              <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                  <?= validation_errors() ?>
                </div>
              <?php endif; ?>

              <form action="<?= base_url('admin/add_product') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <!-- Basic Information -->
                  <div class="col-lg-8">
                    <div class="card">
                      <div class="card-header">
                        <h6 class="mb-0">Basic Information</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="product_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                              <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                  <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label for="stock_quantity" class="form-label">Stock Quantity</label>
                              <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" min="0" value="0">
                            </div>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="description" class="form-label">Description</label>
                          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Product description..."></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="care_instructions" class="form-label">Care Instructions</label>
                          <textarea class="form-control" id="care_instructions" name="care_instructions" rows="3" placeholder="How to care for this product..."></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="materials" class="form-label">Materials</label>
                          <textarea class="form-control" id="materials" name="materials" rows="3" placeholder="Materials used in this product..."></textarea>
                        </div>

                        <div class="mb-3">
                          <label for="story" class="form-label">Product Story</label>
                          <textarea class="form-control" id="story" name="story" rows="4" placeholder="Tell the story behind this product..."></textarea>
                        </div>
                      </div>
                    </div>

                    <!-- Variants -->
                    <div class="card mt-4">
                      <div class="card-header">
                        <h6 class="mb-0">Product Variants</h6>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label for="sizes" class="form-label">Available Sizes</label>
                              <div id="sizes-container">
                                <div class="input-group mb-2">
                                  <input type="text" class="form-control" name="sizes[]" placeholder="e.g., Small, Medium, Large">
                                  <button type="button" class="btn btn-outline-secondary" onclick="addSizeField()">
                                    <i class="ti ti-plus"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label for="colors" class="form-label">Available Colors</label>
                              <div id="colors-container">
                                <div class="input-group mb-2">
                                  <input type="text" class="form-control" name="colors[]" placeholder="e.g., Black, White, Red">
                                  <button type="button" class="btn btn-outline-secondary" onclick="addColorField()">
                                    <i class="ti ti-plus"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="tags" class="form-label">Tags</label>
                          <div id="tags-container">
                            <div class="input-group mb-2">
                              <input type="text" class="form-control" name="tags[]" placeholder="e.g., Handmade, Natural, Organic">
                              <button type="button" class="btn btn-outline-secondary" onclick="addTagField()">
                                <i class="ti ti-plus"></i>
                              </button>
                            </div>
                          </div>
                          <small class="text-muted">Tags help customers find your products</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Sidebar -->
                  <div class="col-lg-4">
                    <!-- Pricing -->
                    <div class="card">
                      <div class="card-header">
                        <h6 class="mb-0">Pricing</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="price" class="form-label">Regular Price <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <span class="input-group-text">₦</span>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="discount_price" class="form-label">Sale Price</label>
                          <div class="input-group">
                            <span class="input-group-text">₦</span>
                            <input type="number" class="form-control" id="discount_price" name="discount_price" step="0.01" min="0">
                          </div>
                          <small class="text-muted">Leave empty if not on sale</small>
                        </div>
                      </div>
                    </div>

                    <!-- Product Highlights -->
                    <div class="card mt-4">
                      <div class="card-header">
                        <h6 class="mb-0">Product Highlights</h6>
                      </div>
                      <div class="card-body">
                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" id="is_best_seller" name="is_best_seller" value="1">
                          <label class="form-check-label" for="is_best_seller">
                            <i class="ti ti-star text-warning me-1"></i>Best Seller
                          </label>
                        </div>

                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" id="is_new_arrival" name="is_new_arrival" value="1">
                          <label class="form-check-label" for="is_new_arrival">
                            <i class="ti ti-sparkles text-info me-1"></i>New Arrival
                          </label>
                        </div>

                        <div class="form-check mb-3">
                          <input class="form-check-input" type="checkbox" id="is_on_sale" name="is_on_sale" value="1">
                          <label class="form-check-label" for="is_on_sale">
                            <i class="ti ti-percentage text-danger me-1"></i>On Sale
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="is_hot_item" name="is_hot_item" value="1">
                          <label class="form-check-label" for="is_hot_item">
                            <i class="ti ti-flame text-primary me-1"></i>Hot Item
                          </label>
                        </div>
                      </div>
                    </div>

                    <!-- Product Images -->
                    <div class="card mt-4">
                      <div class="card-header">
                        <h6 class="mb-0">Product Images</h6>
                      </div>
                      <div class="card-body">
                        <div class="mb-3">
                          <label for="product_images" class="form-label">Upload Images</label>
                          <input type="file" class="form-control" id="product_images" name="product_images[]" multiple accept="image/*">
                          <small class="text-muted">You can select multiple images. First image will be the main image.</small>
                        </div>
                        <div id="image-preview" class="row"></div>
                      </div>
                    </div>

                    <!-- Actions -->
                    <div class="card mt-4">
                      <div class="card-body">
                        <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy me-2"></i>Save Product
                          </button>
                          <button type="submit" name="save_and_add_another" value="1" class="btn btn-outline-primary">
                            <i class="ti ti-plus me-2"></i>Save & Add Another
                          </button>
                          <a href="<?= base_url('admin/products') ?>" class="btn btn-outline-secondary">
                            <i class="ti ti-x me-2"></i>Cancel
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>

<script>
// Add dynamic fields
function addSizeField() {
  const container = document.getElementById('sizes-container');
  const div = document.createElement('div');
  div.className = 'input-group mb-2';
  div.innerHTML = `
    <input type="text" class="form-control" name="sizes[]" placeholder="e.g., Small, Medium, Large">
    <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
      <i class="ti ti-minus"></i>
    </button>
  `;
  container.appendChild(div);
}

function addColorField() {
  const container = document.getElementById('colors-container');
  const div = document.createElement('div');
  div.className = 'input-group mb-2';
  div.innerHTML = `
    <input type="text" class="form-control" name="colors[]" placeholder="e.g., Black, White, Red">
    <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
      <i class="ti ti-minus"></i>
    </button>
  `;
  container.appendChild(div);
}

function addTagField() {
  const container = document.getElementById('tags-container');
  const div = document.createElement('div');
  div.className = 'input-group mb-2';
  div.innerHTML = `
    <input type="text" class="form-control" name="tags[]" placeholder="e.g., Handmade, Natural, Organic">
    <button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()">
      <i class="ti ti-minus"></i>
    </button>
  `;
  container.appendChild(div);
}

// Image preview
document.getElementById('product_images').addEventListener('change', function(e) {
  const preview = document.getElementById('image-preview');
  preview.innerHTML = '';
  
  Array.from(e.target.files).forEach((file, index) => {
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const div = document.createElement('div');
        div.className = 'col-6 mb-2';
        div.innerHTML = `
          <div class="position-relative">
            <img src="${e.target.result}" class="img-fluid rounded" style="height: 100px; object-fit: cover;">
            ${index === 0 ? '<span class="badge bg-primary position-absolute top-0 start-0 m-1">Main</span>' : ''}
          </div>
        `;
        preview.appendChild(div);
      };
      reader.readAsDataURL(file);
    }
  });
});

// Auto-check "On Sale" when discount price is entered
document.getElementById('discount_price').addEventListener('input', function() {
  const saleCheckbox = document.getElementById('is_on_sale');
  if (this.value && parseFloat(this.value) > 0) {
    saleCheckbox.checked = true;
  }
});
</script>
