"""Find 10 working HTTP(S) proxies and save them to a file."""

import asyncio
from proxybroker import Broker


async def save(proxies, filename):
    """Save proxies to a file."""
    with open(filename, 'w') as f:
        f.write('<table>')
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
    tasks = asyncio.gather(broker.find(types=['SOCKS4', 'SOCKS5'], limit=25, countries=['US']),
                           save(proxies, filename='proxies.txt'))
    loop = asyncio.get_event_loop()
    loop.run_until_complete(tasks)


if __name__ == '__main__':
    main()
