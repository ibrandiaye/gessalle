// Line chart
    const ctx1 = document.getElementById('lineChart').getContext('2d');
    new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        datasets: [{
          label: 'Revenus',
          data: [200, 450, 300, 600, 912, 500, 650],
          borderColor: 'red',
          fill: false
        },{
          label: 'Dépenses',
          data: [150, 200, 400, 300, 250, 300, 400],
          borderColor: 'blue',
          fill: false
        }]
      }
    });

    // Doughnut chart
    const ctx2 = document.getElementById('doughnutChart').getContext('2d');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ['Mai', 'Juin', 'Juillet'],
        datasets: [{
          data: [10000, 8000, 5000],
          backgroundColor: ['#3b82f6','#f43f5e','#facc15']
        }]
      }
    });

    // --- destroy existing charts if any ---
if (window.lineChartInstance) { try { window.lineChartInstance.destroy(); } catch(e){} }
if (window.doughnutChartInstance) { try { window.doughnutChartInstance.destroy(); } catch(e){} }

/* Line chart */
(function createLineChart(){
  const canvasL = document.getElementById('lineChart'); if (!canvasL) return; const ctxL = canvasL.getContext('2d');
  window.lineChartInstance = new Chart(ctxL, {
    type: 'line',
    data: {
      labels: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
      datasets: [
        { label: 'Revenus', data: [200,420,260,520,730,912,600], borderColor: '#ef4444', tension: 0.35, pointRadius: 3, pointBackgroundColor: '#ef4444', fill: true,
          backgroundColor: function(context){ const chart = context.chart; const ctx = chart.ctx; const gradient = ctx.createLinearGradient(0,0,0,chart.height); gradient.addColorStop(0,'rgba(239,68,68,0.16)'); gradient.addColorStop(1,'rgba(239,68,68,0.02)'); return gradient; }
        },
        { label: 'Dépenses', data: [150,220,400,300,250,300,420], borderColor: '#3b82f6', tension: 0.35, pointRadius: 3, pointBackgroundColor: '#3b82f6', fill: true,
          backgroundColor: function(context){ const chart = context.chart; const ctx = chart.ctx; const gradient = ctx.createLinearGradient(0,0,0,chart.height); gradient.addColorStop(0,'rgba(59,130,246,0.12)'); gradient.addColorStop(1,'rgba(59,130,246,0.02)'); return gradient; }
        }
      ]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { display: false }, tooltip: { mode: 'nearest', intersect: false } },
      interaction: { mode: 'index', intersect: false },
      scales: { x: { grid: { display: false }, ticks: { color: '#475569' } }, y: { grid: { color: 'rgba(15,23,42,0.04)' }, ticks: { color: '#94a3b8' } } }
    }
  });
})();

// Floating ticket button behaviour (example)
document.addEventListener('DOMContentLoaded', function () {
  const fab = document.getElementById('fabTicket');
  if (!fab) return;

  fab.addEventListener('click', function (e) {
    e.preventDefault();
    // Example action: open tickets panel, scroll to section, or toggle sidebar and highlight Tickets
    // 1) if you want to open the tickets section in the page:
    // const ticketsLink = document.querySelector('a[data-key="tickets"]');
    // if (ticketsLink) ticketsLink.click();

    // 2) example: open overlay sidebar on mobile/tablet and ensure Tickets is active
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay') || document.querySelector('.overlay');

    if (sidebar) {
      // if hidden on mobile/tablet, open it
      sidebar.classList.add('open');
      if (overlay) overlay.classList.add('visible');
      // set Tickets as active
      const ticketsLink = sidebar.querySelector('a[data-key="tickets"]');
      if (ticketsLink) {
        sidebar.querySelectorAll('a').forEach(a => a.classList.remove('active'));
        ticketsLink.classList.add('active');
      }
    }

    // Replace the code above by whatever you want (open modal, navigate, etc.)
    // Example: open a modal function
    // openTicketsModal();
  });
});

/* Doughnut chart */
(function createDoughnutChart(){ const canvasD = document.getElementById('doughnutChart'); if (!canvasD) return; const ctxD = canvasD.getContext('2d'); window.doughnutChartInstance = new Chart(ctxD, { type: 'doughnut', data: { labels: ['Mai','Juin','Juillet'], datasets: [{ data: [10000, 8000, 5000], backgroundColor: ['#3b82f6','#f43f5e','#facc15'], cutout: '65%' }] }, options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { display: false }, tooltip: { callbacks: { label: (context) => `${context.label} — $${context.raw.toLocaleString()}` } } } } }); })();

/* Bubble */
(function bubbleAppearance(){ const bubble = document.getElementById('bubble'); if (!bubble) return; bubble.style.opacity = bubble.style.opacity || '0'; bubble.style.transform = bubble.style.transform || 'translateY(-8px)'; bubble.style.transition = 'transform 420ms cubic-bezier(.22,.9,.32,1), opacity 420ms ease'; setTimeout(() => { bubble.style.opacity = '1'; bubble.style.transform = 'translateY(0)'; }, 80); setTimeout(() => { bubble.animate([{ transform: 'scale(1)' }, { transform: 'scale(1.03)' }, { transform: 'scale(1)' }], { duration: 650, easing: 'ease-in-out', iterations: 1 }); }, 700); })();

/* JS mis à jour — FAB Ticket behavior fixe et robuste
   Remplace l'ancien script toggle par celui-ci (copier/coller avant </body>)
*/
(function(){
  if (window.__dashboardScriptsInstalled) {
    console.info('Dashboard script already installed. Skipping duplicate install.');
    return;
  }
  window.__dashboardScriptsInstalled = true;

  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar') || document.querySelector('.sidebar');
    const content = document.getElementById('main') || document.querySelector('.content');
    let overlay = document.getElementById('sidebarOverlay') || document.querySelector('.overlay');
    const fab = document.getElementById('fabTicket');

    // Create overlay if it doesn't exist (safe)
    if (!overlay) {
      overlay = document.createElement('div');
      overlay.id = 'sidebarOverlay';
      overlay.className = 'overlay';
      document.body.appendChild(overlay);
    }

    // Safety checks
    if (!btn || !sidebar) {
      console.warn('menuToggle or sidebar not found — toggle script disabled.');
      return;
    }

    const isMobile = () => window.innerWidth <= 640;
    const isTablet = () => window.innerWidth > 640 && window.innerWidth <= 800;
    const isDesktop = () => window.innerWidth > 800;

    // Init functions
    function initState() {
      sidebar.classList.remove('open');
      overlay.classList.remove('visible');
      btn.classList.remove('open');

      if (isDesktop()) {
        // preserve any collapsed state but sync main
        content && content.classList.toggle('shift-collapsed', sidebar.classList.contains('collapsed'));
        btn.setAttribute('aria-expanded', sidebar.classList.contains('collapsed') ? 'true' : 'false');
      } else if (isTablet()) {
        sidebar.classList.add('collapsed');
        content && content.classList.add('shift-collapsed');
        btn.setAttribute('aria-expanded', 'false');
      } else {
        sidebar.classList.remove('collapsed');
        content && content.classList.remove('shift-collapsed');
        btn.setAttribute('aria-expanded', 'false');
      }
    }

    // Open overlay (tablet/mobile) — sidebar.open first, overlay after
    function openOverlayMode() {
      sidebar.classList.remove('collapsed'); // ensure labels visible
      sidebar.classList.add('open');

      // Force reflow so browser applies sidebar.open before overlay
      // eslint-disable-next-line no-unused-expressions
      sidebar.offsetWidth;

      requestAnimationFrame(() => {
        overlay.classList.add('visible');
        btn.classList.add('open');
        btn.setAttribute('aria-expanded','true');
      });
    }

    // Close overlay: remove overlay first, then sidebar.open after transition
    function closeOverlayMode() {
      if (!overlay.classList.contains('visible') && !sidebar.classList.contains('open')) return;

      overlay.classList.remove('visible');
      btn.classList.remove('open');
      btn.setAttribute('aria-expanded','false');

      let handled = false;
      const onEnd = (e) => {
        if (e.target === overlay && (e.propertyName === 'opacity' || !e.propertyName)) {
          handled = true;
          sidebar.classList.remove('open');
          if (isTablet()) sidebar.classList.add('collapsed');
          content && content.classList.toggle('shift-collapsed', sidebar.classList.contains('collapsed'));
        }
      };
      overlay.addEventListener('transitionend', onEnd, { once: true });

      setTimeout(() => {
        if (!handled) {
          sidebar.classList.remove('open');
          if (isTablet()) sidebar.classList.add('collapsed');
          content && content.classList.toggle('shift-collapsed', sidebar.classList.contains('collapsed'));
        }
      }, 420);
    }

    // Desktop collapse toggle
    function toggleDesktopCollapse() {
      sidebar.classList.toggle('collapsed');
      const collapsed = sidebar.classList.contains('collapsed');
      content && content.classList.toggle('shift-collapsed', collapsed);
      btn.classList.toggle('open', collapsed);
      btn.setAttribute('aria-expanded', collapsed ? 'true' : 'false');
    }

    // Button toggle behaviour
    btn.addEventListener('click', (ev) => {
      if (ev) ev.preventDefault();
      if (isDesktop()) {
        toggleDesktopCollapse();
      } else {
        if (sidebar.classList.contains('open')) closeOverlayMode(); else openOverlayMode();
      }
    });

    // Overlay click closes overlay
    overlay.addEventListener('click', closeOverlayMode);

    // ESC closes
    document.addEventListener('keydown', (ev) => {
      if (ev.key === 'Escape') {
        if (overlay.classList.contains('visible') || sidebar.classList.contains('open')) closeOverlayMode();
      }
    });

    // Activate Tickets link inside sidebar and scroll into view
    function activateTicketsLink(smooth = false) {
      try {
        // find by data-key or by partial text match (case-insensitive)
        let ticketsLink = sidebar.querySelector('a[data-key="tickets"], a[data-key="ticket"]');
        if (!ticketsLink) {
          // fallback: search by text content
          const anchors = Array.from(sidebar.querySelectorAll('a'));
          ticketsLink = anchors.find(a => (a.textContent || '').toLowerCase().includes('ticket'));
        }
        if (ticketsLink) {
          // remove active on others
          sidebar.querySelectorAll('a').forEach(a => a.classList.remove('active'));
          ticketsLink.classList.add('active');

          // scroll link into view inside sidebar (so user sees it)
          try {
            ticketsLink.scrollIntoView({ block: 'center', behavior: smooth ? 'smooth' : 'auto' });
          } catch (err) {
            // ignore if not supported
          }
        } else {
          console.debug('[FAB] tickets link not found in sidebar');
        }
      } catch (err) {
        console.error('[FAB] activateTicketsLink error', err);
      }
    }

    // Resize handler: debounce, reinit default states & resize charts if present
    let resizeTimer = null;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        if (isDesktop()) {
          overlay.classList.remove('visible');
          sidebar.classList.remove('open');
        }
        initState();
        // Chart.js resize if available
        try {
          if (window.lineChartInstance && typeof window.lineChartInstance.resize === 'function') window.lineChartInstance.resize();
          if (window.doughnutChartInstance && typeof window.doughnutChartInstance.resize === 'function') window.doughnutChartInstance.resize();
        } catch (e) { /* ignore */ }
      }, 160);
    });

    // expose for debug
    window.__sidebarControls = {
      openOverlayMode, closeOverlayMode, toggleDesktopCollapse, initState, activateTicketsLink
    };

    // initial run
    initState();
  }); // DOMContentLoaded
})();