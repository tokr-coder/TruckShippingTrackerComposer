<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Manager - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" data-page="dashboard">
                <i class="fas fa-truck"></i> Shipment Manager
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-page="dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="shipments">Shipments</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content Container -->
    <div id="pageContent">
        <!-- Dashboard Page -->
        <div id="dashboardPage" class="page-content active">
            <!-- Main Content -->
            <div class="container-fluid mt-4">
                <!-- Header with Add Order Button -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h1><i class="fas fa-chart-line"></i> Shipment Dashboard</h1>
                        <p class="text-muted">Manage your shipments and track order capacity</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#addOrderModal">
                            <i class="fas fa-plus"></i> Add New Order
                        </button>
                    </div>
                </div>

                <!-- Holding Area -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-archive"></i> Holding Area
                                    <span class="badge bg-secondary ms-2" id="holdingCount">0</span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="holdingArea" class="holding-area">
                                    <p class="text-muted text-center py-4">
                                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                        Drag orders here to temporarily hold them
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipment Capacity Bars -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-truck"></i> Shipment Capacity
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="shipmentContainer">
                                    <!-- Shipment bars will be dynamically generated here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipment Overview Cards -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white stats-card">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="card-title small mb-1">Total Orders</div>
                                        <div class="h4 mb-0" id="totalOrders">0</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white stats-card">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="card-title small mb-1">Active Shipments</div>
                                        <div class="h4 mb-0" id="activeShipments">0</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-truck"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white stats-card">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="card-title small mb-1">Pending Orders</div>
                                        <div class="h4 mb-0" id="pendingOrders">0</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white stats-card">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="card-title small mb-1">Today's Capacity</div>
                                        <div class="h4 mb-0" id="todayCapacity">0%</div>
                                    </div>
                                    <div>
                                        <i class="fas fa-percentage"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Page -->
        <div id="ordersPage" class="page-content">
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <h1><i class="fas fa-boxes"></i> Orders</h1>
                        <p class="text-muted">Manage and track all orders</p>
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center text-muted py-5">
                                    <i class="fas fa-boxes fa-3x mb-3"></i><br>
                                    Orders page content will be loaded here
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipments Page -->
        <div id="shipmentsPage" class="page-content">
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <h1><i class="fas fa-truck"></i> Shipments</h1>
                        <p class="text-muted">Manage active and completed shipments</p>
                        <div class="card">
                            <div class="card-body">
                                <p class="text-center text-muted py-5">
                                    <i class="fas fa-truck fa-3x mb-3"></i><br>
                                    Shipments page content will be loaded here
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Order Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addOrderForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="orderId" class="form-label">Order ID</label>
                                    <input type="text" class="form-control" id="orderId" required>
                                </div>
                                <div class="mb-3">
                                    <label for="customerName" class="form-label">Customer Name</label>
                                    <input type="text" class="form-control" id="customerName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="customerEmail" class="form-label">Customer Email</label>
                                    <input type="email" class="form-control" id="customerEmail" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="orderWeight" class="form-label">Weight (kg)</label>
                                    <input type="number" step="0.01" class="form-control" id="orderWeight" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orderVolume" class="form-label">Volume (m³)</label>
                                    <input type="number" step="0.01" class="form-control" id="orderVolume" required>
                                </div>
                                <div class="mb-3">
                                    <label for="orderPriority" class="form-label">Priority</label>
                                    <select class="form-select" id="orderPriority">
                                        <option value="1">Low</option>
                                        <option value="2" selected>Normal</option>
                                        <option value="3">High</option>
                                        <option value="4">Urgent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveOrderBtn">Save Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-cog"></i> Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Settings Form -->
                            <form id="settingsForm">
                                <!-- Shipment Capacity Settings -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3">
                                            <i class="fas fa-weight-hanging"></i> Shipment Capacity
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="maxCapacity" class="form-label">Maximum Weight Capacity (kg)</label>
                                            <input type="number" class="form-control" id="maxCapacity" value="1000" min="1" step="0.1">
                                            <div class="form-text">Maximum weight that can be loaded in a single shipment</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="maxVolume" class="form-label">Maximum Volume Capacity (m³)</label>
                                            <input type="number" class="form-control" id="maxVolume" value="10" min="0.1" step="0.1">
                                            <div class="form-text">Maximum volume that can be loaded in a single shipment</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Display Settings -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3">
                                            <i class="fas fa-desktop"></i> Display Settings
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="upcomingShipments" class="form-label">Upcoming Shipments to Display</label>
                                            <select class="form-select" id="upcomingShipments">
                                                <option value="1">1 Shipment</option>
                                                <option value="2" selected>2 Shipments</option>
                                                <option value="3">3 Shipments</option>
                                                <option value="4">4 Shipments</option>
                                                <option value="5">5 Shipments</option>
                                            </select>
                                            <div class="form-text">Number of upcoming shipments to show on dashboard</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ordersPerPage" class="form-label">Orders per Page</label>
                                            <select class="form-select" id="ordersPerPage">
                                                <option value="10">10 Orders</option>
                                                <option value="25" selected>25 Orders</option>
                                                <option value="50">50 Orders</option>
                                                <option value="100">100 Orders</option>
                                            </select>
                                            <div class="form-text">Number of orders to display per page in lists</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="displayMode" class="form-label">Order Display Mode</label>
                                            <select class="form-select" id="displayMode">
                                                <option value="volume" selected>Display by Volume</option>
                                                <option value="weight">Display by Weight</option>
                                            </select>
                                            <div class="form-text">How orders are sized in shipment containers</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- WooCommerce Integration -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3">
                                            <i class="fab fa-wordpress"></i> WooCommerce Integration
                                        </h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="wooCommerceEnabled">
                                                <label class="form-check-label" for="wooCommerceEnabled">
                                                    Enable WooCommerce Integration
                                                </label>
                                            </div>
                                            <div class="form-text">Sync orders with WooCommerce store</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="wooCommerceUrl" class="form-label">WooCommerce Site URL</label>
                                            <input type="url" class="form-control" id="wooCommerceUrl" placeholder="https://yourstore.com">
                                            <div class="form-text">Your WooCommerce store URL</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="wooCommerceKey" class="form-label">Consumer Key</label>
                                            <input type="text" class="form-control" id="wooCommerceKey" placeholder="ck_xxxxxxxxxxxxxxxxxxxx">
                                            <div class="form-text">WooCommerce REST API consumer key</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="wooCommerceSecret" class="form-label">Consumer Secret</label>
                                            <input type="password" class="form-control" id="wooCommerceSecret" placeholder="cs_xxxxxxxxxxxxxxxxxxxx">
                                            <div class="form-text">WooCommerce REST API consumer secret</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="syncInterval" class="form-label">Sync Interval (minutes)</label>
                                            <select class="form-select" id="syncInterval">
                                                <option value="5">5 minutes</option>
                                                <option value="15" selected>15 minutes</option>
                                                <option value="30">30 minutes</option>
                                                <option value="60">1 hour</option>
                                            </select>
                                            <div class="form-text">How often to sync with WooCommerce</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="autoSyncOrders" checked>
                                                <label class="form-check-label" for="autoSyncOrders">
                                                    Auto-Sync New Orders
                                                </label>
                                            </div>
                                            <div class="form-text">Automatically import new orders from WooCommerce</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <!-- Quick Actions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary" id="testWooCommerce">
                                            <i class="fas fa-plug"></i> Test WooCommerce Connection
                                        </button>
                                        <button class="btn btn-outline-info" id="exportSettings">
                                            <i class="fas fa-download"></i> Export Settings
                                        </button>
                                        <button class="btn btn-outline-warning" id="importSettings">
                                            <i class="fas fa-upload"></i> Import Settings
                                        </button>
                                        <button class="btn btn-outline-danger" id="clearData">
                                            <i class="fas fa-trash"></i> Clear All Data
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- System Information -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">System Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted">Version</small>
                                            <div class="fw-bold">1.0.0</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Last Updated</small>
                                            <div class="fw-bold" id="lastUpdated">Never</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <small class="text-muted">Total Orders</small>
                                            <div class="fw-bold" id="totalOrdersSettings">0</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Active Shipments</small>
                                            <div class="fw-bold" id="activeShipmentsSettings">0</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <small class="text-muted">Storage Used</small>
                                            <div class="progress mt-1" style="height: 8px;">
                                                <div class="progress-bar" role="progressbar" style="width: 25%"></div>
                                            </div>
                                            <small class="text-muted">25% of available space</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-secondary" id="resetSettings">
                        <i class="fas fa-undo"></i> Reset to Defaults
                    </button>
                    <button type="submit" form="settingsForm" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Settings Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="settingsFile" class="form-label">Select Settings File</label>
                        <input type="file" class="form-control" id="settingsFile" accept=".json">
                        <div class="form-text">Choose a JSON file containing exported settings</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="importSettingsBtn">Import Settings</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html> 