"""Find 10 working HTTP(S) proxies and save them to a file."""

import datetime
import asyncio
from proxybroker import Broker


async def save(proxies, filename):
    """Save proxies to a file."""
    now = datetime.datetime.now()
    date_string = now.strftime('%b %d, %Y')
    with open(filename, 'w') as f:
        f.write('<table class="table proxy_table"><thead><tr><th>IP:Port</th></tr></thead>')
        f.write('<tr><th>Last Updated: ' + date_string + '</th></tr>')
        while True:
            proxy = await proxies.get()
            if proxy is None:
                break
            proto = 'socks5' if 'SOCKS5' in proxy.types else 'socks4'
            row = '<tr><td>%s:%d</td></tr>\n' % (proxy.host, proxy.port)
            f.write(row)
        f.write('</table>')


def main():
    proxies = asyncio.Queue()
    broker = Broker(proxies)
    tasks = asyncio.gather(broker.find(types=['SOCKS5'], limit=25, countries=['US'], timeout=5),
                           save(proxies, filename='proxies.txt'))
    loop = asyncio.get_event_loop()
    loop.run_until_complete(tasks)


if __name__ == '__main__':
    main()
