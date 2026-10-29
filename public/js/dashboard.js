/**
 * ====================================================================
 * DASHBOARD JAVASCRIPT (dashboard.js)
 * ====================================================================
 * Controls interactive charts, live searching, status filtering,
 * and view toggling (Cards Grid vs Compact Table).
 * ====================================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    // -------------------------------------------------------------
    // 1. Chart Data Extraction (from window.dashboardData)
    // -------------------------------------------------------------
    const data = window.dashboardData || {};
    const categoryChartData = data.categoryChart || [];
    const quizChartData = data.quizChart || [];

    const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark' ||
                       document.documentElement.getAttribute('data-bs-theme') === 'dark';

    const textColor = isDarkMode ? '#cbd5e1' : '#475569';
    const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.08)' : 'rgba(0, 0, 0, 0.06)';

    // -------------------------------------------------------------
    // 2. Bar Chart: Questions per Quiz
    // -------------------------------------------------------------
    const quizCtx = document.getElementById('quizBarChart');
    if (quizCtx && quizChartData.length > 0) {
        const labels = quizChartData.map(q => q.name);
        const dataValues = quizChartData.map(q => q.mcq_count);

        new Chart(quizCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'MCQ Questions',
                    data: dataValues,
                    backgroundColor: dataValues.map(v => v > 0 ? 'rgba(79, 70, 229, 0.8)' : 'rgba(245, 158, 11, 0.4)'),
                    borderColor: dataValues.map(v => v > 0 ? '#4f46e5' : '#f59e0b'),
                    borderWidth: 1.5,
                    borderRadius: 6,
                    maxBarThickness: 38
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Questions: ${context.raw} MCQs`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: textColor,
                            font: { family: 'Plus Jakarta Sans', size: 11 }
                        },
                        grid: { color: gridColor }
                    },
                    x: {
                        ticks: {
                            color: textColor,
                            font: { family: 'Plus Jakarta Sans', size: 10 },
                            maxRotation: 30,
                            minRotation: 0
                        },
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // -------------------------------------------------------------
    // 3. Doughnut Chart: Quizzes by Category
    // -------------------------------------------------------------
    const categoryCtx = document.getElementById('categoryPieChart');
    if (categoryCtx && categoryChartData.length > 0) {
        const catLabels = categoryChartData.map(c => c.name);
        const catCounts = categoryChartData.map(c => c.quiz_count);

        const vibrantPalette = [
            '#4f46e5', // Indigo
            '#10b981', // Emerald
            '#f59e0b', // Amber
            '#06b6d4', // Cyan
            '#8b5cf6', // Violet
            '#ec4899', // Pink
            '#64748b'  // Slate
        ];

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: catLabels,
                datasets: [{
                    data: catCounts,
                    backgroundColor: vibrantPalette.slice(0, catLabels.length),
                    borderWidth: 2,
                    borderColor: isDarkMode ? '#1e293b' : '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            font: { family: 'Plus Jakarta Sans', size: 11 },
                            boxWidth: 12,
                            padding: 12
                        }
                    }
                }
            }
        });
    }

    // -------------------------------------------------------------
    // 4. Live Search & Filter Tabs for Quizzes (Cards & Table)
    // -------------------------------------------------------------
    const searchInput = document.getElementById('liveQuizSearch');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.quiz-item-card');
    const tableRows = document.querySelectorAll('.quiz-table-row');
    const countBadge = document.getElementById('quizCountBadge');

    let currentFilter = 'all';

    function applyFilters() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;

        // Filter Grid Cards
        cards.forEach(card => {
            const status = card.getAttribute('data-status');
            const name = card.getAttribute('data-name');
            const cat = card.getAttribute('data-category');

            const matchesFilter = (currentFilter === 'all') || (status === currentFilter);
            const matchesQuery = !query || name.includes(query) || cat.includes(query);

            if (matchesFilter && matchesQuery) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Filter Table Rows (if present)
        tableRows.forEach(row => {
            const status = row.getAttribute('data-status');
            const name = row.getAttribute('data-name');
            const cat = row.getAttribute('data-category');

            const matchesFilter = (currentFilter === 'all') || (status === currentFilter);
            const matchesQuery = !query || name.includes(query) || cat.includes(query);

            row.style.display = (matchesFilter && matchesQuery) ? '' : 'none';
        });

        if (countBadge) {
            countBadge.textContent = `${visibleCount} Quizzes`;
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.getAttribute('data-filter');
            applyFilters();
        });
    });

    // -------------------------------------------------------------
    // 5. View Switcher (Grid Cards vs Compact Table)
    // -------------------------------------------------------------
    const btnViewGrid = document.getElementById('btnViewGrid');
    const btnViewList = document.getElementById('btnViewList');
    const gridView = document.getElementById('quizGridView');
    const tableView = document.getElementById('quizTableView');

    if (btnViewGrid && btnViewList && gridView && tableView) {
        btnViewGrid.addEventListener('click', function() {
            btnViewGrid.classList.add('active');
            btnViewList.classList.remove('active');
            if (gridView) gridView.classList.remove('d-none');
            if (tableView) tableView.classList.add('d-none');
        });

        btnViewList.addEventListener('click', function() {
            btnViewList.classList.add('active');
            btnViewGrid.classList.remove('active');
            if (tableView) tableView.classList.remove('d-none');
            if (gridView) gridView.classList.add('d-none');
        });
    }
});
