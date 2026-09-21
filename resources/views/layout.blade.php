<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon"
          href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1888' height='1888' fill='%23ff4500'%3E%3Cpath d='M791.5 1714L215 1381.5c-8.5-5.5-15-8.5-15-19.5V357.5c0-8.158 5-13.5 9.5-16L502 173c9.5-5.5 17.5-5.5 26.5 0L819 340c11.5 6.5 12 15 12 22.5v622L1073.5 845V527c0-11 5-17.5 17-24.5L1380 336c7-4 12.5-4 19.5 0l295 170c9.5 5.5 10.5 12 10.5 21.5V858c0 10.5-2.5 16-13 22.5l-278.5 160v317c0 12.5-3 17.5-14 24L821 1714c-11 6-18.5 6-29.5 0z'/%3E%3C/svg%3E">
    <title>{{ config('app.name') }} — Info</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:            #0b0b0d;
            --surface:       #111114;
            --surface-hover: #17171c;
            --border:        #1d1d25;
            --border-hi:     #2a2a38;
            --text-dim:      #3d3d52;
            --text-muted:    #636380;
            --text:          #9898b8;
            --text-bright:   #e4e4f4;
            --accent:        #ff4500;
            --green:         #3ddc84;
            --red:           #ff5f5f;
            --yellow:        #f0a050;
            --mono:          'SF Mono', 'Fira Code', 'Cascadia Code', 'Consolas', 'Courier New', monospace;
        }

        html { font-size: 14px; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--mono);
            min-height: 100vh;
            padding-bottom: 72px;
        }

        body::before {
            content: '';
            display: block;
            height: 2px;
            background: linear-gradient(90deg, var(--accent) 0%, #ff8c00 40%, transparent 100%);
        }

        /* ── Header ── */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 40px;
            border-bottom: 1px solid var(--border);
        }

        .h-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .h-logo {
            flex-shrink: 0;
            opacity: .9;
        }

        .h-appname {
            font-size: .95rem;
            font-weight: 600;
            color: var(--text-bright);
            letter-spacing: -.02em;
        }

        .h-env {
            font-size: .65rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--text-muted);
            border: 1px solid var(--border-hi);
            border-radius: 3px;
            padding: 2px 7px;
        }

        .h-proto {
            font-size: .65rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--text-muted);
            border: 1px solid var(--border-hi);
            border-radius: 3px;
            padding: 2px 7px;
        }

        .h-label {
            font-size: .65rem;
            text-transform: uppercase;
            letter-spacing: .14em;
            color: var(--text-dim);
        }

        /* ── Grid ── */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 36px 40px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 16px;
        }

        /* ── Section card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 6px;
            overflow: hidden;
            opacity: 0;
            animation: rise .35s ease forwards;
        }

        .card:nth-child(1) { animation-delay: .00s; }
        .card:nth-child(2) { animation-delay: .05s; }
        .card:nth-child(3) { animation-delay: .10s; }
        .card:nth-child(4) { animation-delay: .15s; }
        .card:nth-child(5) { animation-delay: .20s; }
        .card:nth-child(6) { animation-delay: .25s; }
        .card:nth-child(7) { animation-delay: .30s; }
        .card:nth-child(8) { animation-delay: .35s; }

        @keyframes rise {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-bottom: 1px solid var(--border);
            font-size: .62rem;
            text-transform: uppercase;
            letter-spacing: .14em;
            color: var(--text-muted);
        }

        .card-title::before {
            content: '';
            width: 5px;
            height: 5px;
            background: var(--accent);
            border-radius: 1px;
            flex-shrink: 0;
        }

        /* ── Table ── */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px solid var(--border);
            transition: background .1s;
        }

        tr:last-child { border-bottom: none; }
        tr:hover { background: var(--surface-hover); }

        td {
            padding: 8px 14px;
            font-size: .8rem;
            line-height: 1.5;
            vertical-align: middle;
        }

        .k {
            color: var(--text-muted);
            width: 38%;
            white-space: nowrap;
        }

        .v { color: var(--text-bright); word-break: break-all; }

        /* value-aware coloring */
        .v[data-v="true"],
        .v[data-v="ok"],
        .v[data-v="active"],
        .v[data-v="running"],
        .v[data-v="cached"]     { color: var(--green); }

        .v[data-v="false"],
        .v[data-v="error"],
        .v[data-v="not cached"] { color: var(--red); }

        .v[data-v="inactive"]   { color: var(--yellow); }

        /* ── Footer ── */
        footer {
            margin-top: 44px;
            text-align: center;
            font-size: .65rem;
            color: var(--text-dim);
            letter-spacing: .08em;
        }
    </style>
</head>
<body>

<header>
    <div class="h-left">
        <svg class="h-logo" width="22" height="22" viewBox="0 0 1888 1888" fill="#ff4500" xmlns="http://www.w3.org/2000/svg">
            <path d="M791.5 1714L215 1381.5c-8.5-5.5-15-8.5-15-19.5V357.5c0-8.158 5-13.5 9.5-16L502 173c9.5-5.5 17.5-5.5 26.5 0L819 340c11.5 6.5 12 15 12 22.5v622L1073.5 845V527c0-11 5-17.5 17-24.5L1380 336c7-4 12.5-4 19.5 0l295 170c9.5 5.5 10.5 12 10.5 21.5V858c0 10.5-2.5 16-13 22.5l-278.5 160v317c0 12.5-3 17.5-14 24L821 1714c-11 6-18.5 6-29.5 0z"/>
        </svg>
        <span class="h-appname">{{ config('app.name') }}</span>
        <span class="h-env">{{ app()->environment() }}</span>
        <span class="h-proto">{{ request()->isSecure() ? 'HTTPS' : 'HTTP' }}</span>
    </div>
    <span class="h-label">System Info</span>
</header>

<div class="container">
    <div class="grid">
        @foreach($sections as $title => $rows)
            <div class="card">
                <div class="card-title">{{ $title }}</div>
                <table>
                    @foreach($rows as $key => $value)
                        <tr>
                            <td class="k">{{ $key }}</td>
                            <td class="v" data-v="{{ strtolower((string) $value) }}">{{ $value }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>

    <footer>laravel-info &nbsp;&mdash;&nbsp; {{ now()->format('Y-m-d H:i:s T') }}</footer>
</div>

</body>
</html>
