---
title: "How to Setup a Tier.net VPS for Runescape Botting"
draft: false
date: "2019-01-13"
tags: ["Proxy", "VPS"]
aliases: ["/tier-net-runescape-botting-vps/"]
sharingicons: false
---
Virtual private servers (or VPSs) are commonly used by Runescape goldfarmers as a cost effective way to expand their botfarms. You can think of a VPS as a remote computer that you rent.<!--more--> Some benefits that make a VPS appealing to botters are:

- They stay online and running your bots, even when your PC is off
- Cheap and easy way to expand your goldfarm
- Come with their own unique IP address (acts as a [proxy](https://rsbotspot.com/post/all-about-proxies-for-runescape-botting/))

After hours of researching a well priced and high performance VPS for Runescape botting, [Tier.net](https://billing.tier.net/aff.php?aff=85) caught my attention. They have a good price/performance ratio, allow botting, and even give extra IPs with each VPS plan.

Often times, the technical aspect of setting a VPS can be daunting. This guide is geared towards absolute beginners, and covers how to setup a Tier.net VPS for Runescape Botting.
<!--more-->

## Choosing a VPS Plan
[Tier.net](https://billing.tier.net/aff.php?aff=85&gid=54) offers four different VPS plans:
<div class="caption">
![Tier.net VPS Options](/img/tier net pricing table.png)
<p class="caption-text">Tier.net VPS Options</p>
</div>

One of the main things to consider when choosing VPS is the amount of RAM it has. To be safe, I recommend getting 1GB of RAM per bot you plan to run. Since most bots don't take 1GB RAM per client, you may be able to run more clients than expected. Here's an estimate of many bots you can run in each plan:

- VPS Bronze | At least 2 bots
- VPS Silver | At least 4 bots
- VPS Gold | At least 8 bots
- VPS Platinum | At least 12 bots

For this review, I'll be using the VPS Silver plan.

## Ordering Your VPS
Visit the [Tier.net VPS page](https://billing.tier.net/aff.php?aff=85&gid=54) and select a plan.

Next you'll to set a couple options on the **Product Configuration** page:

- **Hostname** - Can be anything alphanumeric, you don't need to remember this.
- **Root Password** - Set a strong password, and note it down.
- **Operating System** - I recommend Debian 7.X 64-bit.</br><small>We recommend upgrading to Debian 8 in the control panel after ordering. Contact Tier.net support if you need a hand with this.</small>

All other options can be left as default.

Then complete payment and you're done.
[Tier.net](https://billing.tier.net/aff.php?aff=85) accepts: Paypal, Credit/Debit Card, and Bitcoin.

Before delivering, [Tier.net](https://billing.tier.net/aff.php?aff=85) seems to prescreen customers regarding usage. I received a ticket asking some questions, and gave them an honest answer to the effect of:<div height="1em"></div>
<div class="caption" style="text-align:left;">
"I am using this server to run automation scripts for a video game. The scripts will run for under 8 hours a day, and never over 2 hours at once. I will take care to respect and not max out the CPU/RAM resources of the server."
</div>
They gladly accepted my answer and delivered the VPS! It took about 6 hours from payment for my VPS to become available.

Now we need to connect to and setup the VPS for Runescape botting.

## Connecting to & Setting Up Your VPS
Once you have access to your VPS, you'll need to set it up for Runescape botting. This includes installing a desktop environment and VNC software to view to your VPS.

The next steps will be done using SSH in the terminal. SSH allows you to run commands on the VPS.

Mac and updated Windows 10 allow for SSH in the terminal. You may need to [enable SSH](https://www.howtogeek.com/336775/how-to-enable-and-use-windows-10s-built-in-ssh-commands/) on some Windows machines or use a program called [Putty](https://www.putty.org/).

Once you have a terminal open, simply follow the steps below.</br><small>Note: You don't need to type the "$'s"</small>
### 1. SSH into your VPS
{{< highlight bash >}}
$ ssh root@192.888.888.88
{{< / highlight >}}
Replace 192.888.888.88 with your VPS's IP address. You can find this in by going to: [Tier.net](https://billing.tier.net/aff.php?aff=85) > Login > Services > Click your VPS > Primary IP

After this command, you'll be asked to enter your root password, which you set on purchase. (You have also gotten an email with a new root password after ordering)
### 2. Install XFCE Desktop Environment & VNC
Update & upgrade your packages.
{{< highlight bash >}}
$ apt-get update
$ apt-get upgrade -y
{{< / highlight >}}

If you run into any errors, you may need to comment out any CD ROM sources on your VPS as per [this guide](https://www.velocihost.net/clients/knowledgebase/29/Fix-the-apt-get-install-error-Media-change-please-insert-the-disc-labeled--on-your-Linux-VPS.html).

Install XFCE & TightVNCServer
{{< highlight bash >}}
$ apt-get install xfce4 xfce4-goodies tightvncserver
{{< / highlight >}}

### 3. Setup a  User to Run VNC
Create a new user, switch to it, and start the VNCServer.
{{< highlight bash >}}
$ adduser vnc
$ usermod -aG sudo vnc
$ su - vnc
$ vncserver
{{< / highlight >}}
Make sure to note down any passwords you set on this step.

### 4. Install Java & TRiBot
Follow [these steps](https://tecadmin.net/install-java-8-on-debian/) to install Java.

Navigate to the desktop, and install TRiBot with:
{{< highlight bash >}}
$ cd desktop
$ wget https://tribot.org/bin/TRiBot_Loader.jar
{{< / highlight >}}

## 5. Connect to your VPS
Now that you've got everything installed, you're ready to connect to your VPS!

Start by downloading a VNC viewer, I'll be using [TigerVNC](https://tigervnc.org/), as I found it to have the good performance. You can find the downloads [here](https://bintray.com/tigervnc/stable/tigervnc/1.9.0), get the .exe for Windows, or .dmg or Mac.

Run TigerVNC and enter your server IP, port 5901, and your VNC password to connect. Accept any security prompts that may pop up, and enter the password you set in step #3.
<div class="caption">
![Tier.net VPS Options](/img/runescape-botting-VPS-VNC.png)
<p class="caption-text">VNC Login Window</p>
</div>

After connecting, simply double-click TRiBot_Loader.jar on the desktop to start botting!
<div class="caption">
![Tier.net VPS Options](/img/Debian-8-VPS-Runescape-Botting-TRiBot.png)
<p class="caption-text">TRiBot on Debian 8 VPS</p>
</div>

## Helpful VPS Setup Resources
Here's some guides I found helpful when setting up my VPS for Runescape botting.

- [XFCE usage for VNC access to your Debian 8 server](https://community.time4vps.eu/discussion/358/debian-xfce-usage-for-vnc-access-to-your-debian-8-server)
- [How To Set Up VNC Server on Debian 8](https://www.digitalocean.com/community/tutorials/how-to-set-up-vnc-server-on-debian-8)
- [Install JDK8 on Debian](https://tecadmin.net/install-java-8-on-debian/)

## Helpful Tips
 - View your VPS by connecting to VNC (Step 5 above)
 - You can close your VNC viewer, and your bots will continue to run
 - If you're having trouble connecting via VNC, use these terminal commands to restart your VNC server:
 {{< highlight bash >}}
 $ ssh root@192.888.888.88
 $ vncserver -kill :1
 $ vncserver
{{< / highlight >}}
 - While a VPS may seem laggy over VNC, what you're actually seeing is just latency. You can use a task manager to check a VPSs resources, and if it's not maxed out, you're OK.
 - For a more resilient VNC connection, check out the VNC configs mentioned in the first two links above.

## Thoughts & More to Come
[Tier.net's](https://billing.tier.net/aff.php?aff=85) pricing, support, and easy setup make it an appealing VPS provider for Runescape botting.

I've only used my VPS for a couple days so far, but everything is running smoothly. Looking forward to updating this post with some results from botting!


<!-- <div class="container">
 <div class="row justify-content-center">
  <i class="fas fa-star fa-3x"></i>
  <i class="fas fa-star fa-3x"></i>
  <i class="fas fa-star fa-3x"></i>
  <i class="fas fa-star fa-3x"></i>
  <i class="fas fa-star fa-3x"></i>
  </div>
  <div class="row justify-content-center">
  <h3>5/5  Stars</h3>
  </div>
</div> -->


