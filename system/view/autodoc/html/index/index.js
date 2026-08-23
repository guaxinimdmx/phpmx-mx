document.addEventListener('DOMContentLoaded', function () {
    var input = document.querySelector('.search input');
    var results = document.querySelector('.search-results');
    var overlay = document.querySelector('.search-overlay');

    if (!input || !results || typeof MX_SEARCH === 'undefined') return;

    var base = typeof MX_BASE === 'undefined' ? '' : MX_BASE;

    var labels = {
        constant: 'Constant',
        function: 'Function',
        environment: 'Environment',
        middleware: 'Middleware',
        terminal: 'Terminal',
        route: 'Route',
        class: 'Class',
        method: 'Method',
        property: 'Property',
        example: 'Example',
        database: 'Database',
        field: 'Field',
    };

    function hide() {
        results.hidden = true;
        results.innerHTML = '';

        if (overlay) overlay.hidden = true;
        document.body.style.overflow = '';
    }

    function position() {
        var rect = input.getBoundingClientRect();
        results.style.top = (rect.bottom + 4) + 'px';
        results.style.left = rect.left + 'px';
    }

    function render(matches) {
        results.innerHTML = '';

        if (!matches.length) {
            hide();
            return;
        }

        position();

        matches.slice(0, 20).forEach(function (item) {
            var a = document.createElement('a');
            a.href = base + item.link;

            var key = document.createElement('span');
            key.className = 'result-key';
            key.textContent = item.key;

            var type = document.createElement('span');
            type.className = 'result-type';
            type.textContent = labels[item.type] || item.type;

            a.appendChild(key);
            a.appendChild(type);
            results.appendChild(a);
        });

        results.hidden = false;

        if (overlay) overlay.hidden = false;
        document.body.style.overflow = 'hidden';
    }

    input.addEventListener('input', function () {
        var q = input.value.trim().toLowerCase();

        if (!q) {
            hide();
            return;
        }

        var matches = MX_SEARCH.filter(function (item) {
            return item.key.toLowerCase().indexOf(q) !== -1;
        });

        render(matches);
    });

    document.addEventListener('click', function (ev) {
        if (ev.target !== input && !results.contains(ev.target)) hide();
    });

    window.addEventListener('scroll', function (ev) {
        if (results.contains(ev.target)) return;
        hide();
    }, true);
    window.addEventListener('resize', hide);
});
