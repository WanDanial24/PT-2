<?php
ob_start();
?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Products</h2>
        <p class="text-muted mb-0">Manage and track all your products</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <!-- Form Header -->
        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>
                    <?php echo isset($aproduct) ? 'Edit Product' : 'Product Form'; ?>
                </h5>
                <small class="text-muted">Fill in the details of a product</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">* Required fields</span>
            </div>
        </div>

        <hr>

        <form action="<?= BASE_URL ?>productcontroller/<?= isset($aproduct) ? 'update' : 'save' ?>" method="post" class="needs-validation" novalidate>

            <?php if (isset($aproduct)): ?>
                <input type="hidden" name="original_product_num"
                    value="<?php echo htmlspecialchars($aproduct['fld_product_num']); ?>">
            <?php endif; ?>

            <div class="row g-3">

                <div class="col-md-3">
                    <label for="pid" class="form-label">Product ID <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_num" id="pid" type="text" class="form-control" placeholder="Enter Product ID"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_num']) : ''; ?>" required>
                </div>

                <div class="col-md-3">
                    <label for="name" class="form-label">Name <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_name" id="name" type="text" class="form-control" placeholder="Enter Product Name"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_name']) : ''; ?>" required>
                </div>

                <div class="col-md-3">
                    <label for="price" class="form-label">Price (RM) <span class="text-danger" aria-hidden="true">*</span></label>  
                    <input name="product_price" id="price" type="number" class="form-control" placeholder="Enter Price (RM)"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_price']) : ''; ?>" required min="0" step="0.01">
                </div>

                <div class="col-md-3">
                    <label for="brand" class="form-label">Brand <span class="text-danger" aria-hidden="true">*</span></label>
                    <?php
                    $brands = ['Recipe House', 'Kitchen Stories', 'Healthy Bites', 'Quick Cook'];
                    $selectedBrand = $aproduct['fld_product_brand'] ?? '';
                    ?>
                    <select name="product_brand" id="brand" class="form-select" required>
                        <option value="">Select Brand</option>

                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= htmlspecialchars($brand, ENT_QUOTES, 'UTF-8') ?>"
                                <?= $selectedBrand === $brand ? 'selected' : '' ?>>
                                <?= htmlspecialchars($brand, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="category" class="form-label">
                        Recipe Category <span class="text-danger" aria-hidden="true">*</span>
                    </label>

                    <?php
                    $categories = [
                        'Malaysian Cuisine',
                        'Western Cuisine',
                        'Desserts and Baking',
                        'Healthy Recipes',
                        'Vegetarian'
                    ];

                    $selectedCategory = $aproduct['fld_product_condition'] ?? '';
                    ?>

                    <select name="product_condition" id="category" class="form-select" required>
                        <option value="">Select Category</option>

                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>"
                                <?= $selectedCategory === $category ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>        
                
                <div class="col-md-3">
                    <label for="year" class="form-label">
                        Publication Year <span class="text-danger" aria-hidden="true">*</span>
                    </label>

                    <?php
                    $years = range(2020, 2026);
                    $selectedYear = (string)($aproduct['fld_product_year'] ?? '');
                    ?>

                    <select name="product_year" id="year" class="form-select" required>
                        <option value="">Select Year</option>

                        <?php foreach ($years as $year): ?>
                            <option value="<?= $year ?>"
                                <?= $selectedYear === (string)$year ? 'selected' : '' ?>>
                                <?= $year ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger" aria-hidden="true">*</span></label>         
                    <input name="product_quantity" id="quantity" type="number" class="form-control" placeholder="Enter Quantity"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_quantity']) : ''; ?>" required min="0">
                </div>

                <div class="col-md-3">
                    <label for="product_image" class="form-label">Image</label>
                    <input name="product_image" id="product_image" type="text" class="form-control" placeholder="Enter image filename"
                        value="<?php echo isset($aproduct) ? htmlspecialchars($aproduct['fld_product_image']) : ''; ?>">
                </div>

            </div>

            <hr class="mt-4 mb-3">

            <div>
                <button type="submit" name="<?= isset($aproduct) ? 'update' : 'create' ?>" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i><?= isset($aproduct) ? 'Update' : 'Create' ?>
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-table text-primary me-2"></i>
                    Product List
                </h5>
                <small class="text-muted">View and manage all products in the inventory</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">
                    Total: <?php echo count($products); ?> items
                </span>
            </div>

        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['fld_product_num']); ?></td>
                                <td><?php echo htmlspecialchars($product['fld_product_name']); ?></td>
                                <td>RM<?php echo number_format((float)$product['fld_product_price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($product['fld_product_brand']); ?></td>
                                <td>
                                    <a href="<?=BASE_URL; ?>productcontroller/edit/<?php echo htmlspecialchars($product['fld_product_num']); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-image"></i>
                                    </button>
                                    <a href="<?= BASE_URL ?>productcontroller/delete/<?= $product['fld_product_num'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No products found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>