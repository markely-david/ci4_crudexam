<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h2>Dashboard</h2>
        <p>Welcome back, <strong style="color:var(--navy-700);"><?= esc(session('user')['fullname'] ?? 'User') ?></strong>. Here's your platform overview.</p>
    </div>
    <button class="clean-btn-gold"><i class="bi bi-download"></i> Export Report</button>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-indigo-50 text-indigo-600"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value">1,248</div>
            <div class="stat-label">Total Users</div>
            <div class="stat-change up"><i class="bi bi-arrow-up-right"></i> 12% from last month</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-emerald-50 text-emerald-600"><i class="bi bi-person-check-fill"></i></div>
            <div class="stat-value">892</div>
            <div class="stat-label">Active Students</div>
            <div class="stat-change up"><i class="bi bi-arrow-up-right"></i> 5% from last month</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-amber-50 text-amber-600"><i class="bi bi-person-plus-fill"></i></div>
            <div class="stat-value">156</div>
            <div class="stat-label">New Registrations</div>
            <div class="stat-change down"><i class="bi bi-arrow-down-right"></i> 2% from last month</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-rose-50 text-rose-600"><i class="bi bi-activity"></i></div>
            <div class="stat-value">99.9%</div>
            <div class="stat-label">System Uptime</div>
            <div class="stat-change neutral">All services operational</div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-3">
    <div class="col-lg-8">
        <div class="clean-card">
            <div class="clean-card-header">
                <h6><i class="bi bi-bar-chart-line-fill"></i> Platform Activity — Last 6 Months</h6>
            </div>
            <div class="p-4">
                <div id="activity-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="clean-card h-100">
            <div class="clean-card-header">
                <h6><i class="bi bi-pie-chart-fill"></i> User Distribution</h6>
            </div>
            <div class="p-4">
                <div id="donut-chart"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
<script>
new ApexCharts(document.querySelector('#activity-chart'), {
    series: [
        { name: 'Logins',        data: [850, 920, 1100, 1050, 1250, 1320] },
        { name: 'Registrations', data: [120, 150, 110,  130,  180,  156]  }
    ],
    chart: { height: 300, type: 'area', toolbar: { show: false }, fontFamily: 'Outfit, sans-serif' },
    colors: ['#162d58', '#e8b923'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2.5 },
    fill: { type: 'gradient', gradient: { opacityFrom: 0.18, opacityTo: 0.02 } },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        axisBorder: { show: false }, axisTicks: { show: false },
        labels: { style: { fontFamily: 'Outfit, sans-serif', fontWeight: 600 } }
    },
    grid: { borderColor: '#e8eef5', strokeDashArray: 4 },
    legend: { position: 'top', horizontalAlign: 'right', fontFamily: 'Outfit, sans-serif', fontWeight: 600 }
}).render();

new ApexCharts(document.querySelector('#donut-chart'), {
    series: [540, 320, 210, 178],
    labels: ['Students', 'Teachers', 'Admins', 'Others'],
    chart: { height: 300, type: 'donut', fontFamily: 'Outfit, sans-serif' },
    colors: ['#162d58', '#e8b923', '#254d8f', '#d4a017'],
    legend: { position: 'bottom', fontFamily: 'Outfit, sans-serif', fontWeight: 600 },
    dataLabels: { enabled: false },
    plotOptions: { pie: { donut: { size: '68%', labels: { show: true, total: { show: true, label: 'Total', fontFamily: 'Outfit, sans-serif', fontWeight: 700 } } } } }
}).render();
</script>
<?= $this->endSection() ?>
