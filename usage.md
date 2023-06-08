---
title: Usage
layout: default
---

# Usage

After you have installed PHP-Badges, you can start using it.

**Note:** In the following examples, the Badges are scaled down due to the limitation of jeckyll (our website generator).

## List of contents

<!-- Unfoldable TOC -->
<details>
<summary>Click to expand</summary>

- [Usage](#usage)
  - [List of contents](#list-of-contents)
  - [Simple usage](#simple-usage)
    - [Label](#label)
    - [Message](#message)
    - [Color](#color)
      - [Color Codes](#color-codes)
    - [Icon](#icon)
      - [Icon Codes](#icon-codes)
  - [Advanced Usage](#advanced-usage)
    - [Image Format](#image-format)
    - [Image Scale](#image-scale)
    - [Label Color](#label-color)
    - [Font Color](#font-color)
    - [Cache Lifetime](#cache-lifetime)
    - [Status of PHP-Badges](#status-of-php-badges)
      - [Status Viewer](#status-viewer)
  - [Conclusion](#conclusion)

</details>

## Simple usage

To change the badge, you just need to add some parameters to the URL, all* of the parameters can be used together.

All parameters are optional, the default values are:

<!-- $icon = '&#xf09b;'; // Default Font Awesome icon
$label = 'Documentation:'; // Default label
$message = 'go.jm26.net/badge-docs'; // Default message
$labelColor = '#555555'; // Default label color
$messageColor = '#97CA00'; // Default message color
$colorText = '#ffffff'; // Default text color
$autoFontColor = true; // Automatically change the text color to black or white depending on the background color
// Advanced settings
$imageFormat = 'png'; // Default image format (png, jpg, gif)
$cacheLife = 5; // Default cache life (in seconds)
$scale = 15; // Image scale (Higher = Better quality, but bigger file size.)
$maxScale = 100; // Maximum image scale
$resizeOutput = false; // Downscale the output image to the original size. (!Reduces quality!) -->

| Parameter | Default Value |
| --------- | ------------- |
| label     | Documentation |
| message   | go.jm26.net/badge-docs |
| color     | #97CA00 |
| icon      | `&#xf09b;` (f09b - GitHub) |

E.g. `https://api.jm26.net/badge?label=Hello&message=World`


### Label

The Label is the text on the left side of the badge.

To set the label, use the `label` parameter.

E.g. `https://api.jm26.net/badge?label=Hello`: ![Hello](https://api.jm26.net/badge?label=Hello&message=&scale=1)

### Message

The Message is the text on the right side of the badge.

To set the message, use the `message` parameter.

E.g. `https://api.jm26.net/badge?message=World`: ![World](https://api.jm26.net/badge?label=&message=World&scale=1)

### Color

The Color is the background color of the right side of the badge (the message).

To set the color, use the `color` parameter.

E.g. `https://api.jm26.net/badge?color=blue`: ![blue](https://api.jm26.net/badge/beta?color=blue&scale=1&icon=)

#### Color Codes

PHP-Badges supports HEX color codes and some color names:

<details>
<summary>Click to expand</summary>

**Some colors are only available in newer versions of PHP-Badges.**

<table>
  <thead>
    <tr>
      <th>Color Name</th>
      <th>HEX Code</th>
      <th>Preview</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>red</td>
      <td>#e05d44</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=red&amp;color=red&amp;scale=1" alt="red"></td>
    </tr>
    <tr>
      <td>orange</td>
      <td>#fe7d37</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=orange&amp;color=orange&amp;scale=1" alt="orange"></td>
    </tr>
    <tr>
      <td>yellow</td>
      <td>#dfb317</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=yellow&amp;color=yellow&amp;scale=1" alt="yellow"></td>
    </tr>
    <tr>
      <td>green</td>
      <td>#97CA00</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=green&amp;color=green&amp;scale=1" alt="green"></td>
    </tr>
    <tr>
      <td>brighgreen</td>
      <td>#44cc11</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=brighgreen&amp;color=brighgreen&amp;scale=1" alt="brighgreen"></td>
    </tr>
    <tr>
      <td>cyan</td>
      <td>#00eaff</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=cyan&amp;color=cyan&amp;scale=1" alt="cyan"></td>
    </tr>
    <tr>
      <td>blue</td>
      <td>#007ec6</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=blue&amp;color=blue&amp;scale=1" alt="blue"></td>
    </tr>
    <tr>
      <td>violet</td>
      <td>#7b16ff</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=violet&amp;color=violet&amp;scale=1" alt="violet"></td>
    </tr>
    <tr>
      <td>pink</td>
      <td>#ff69b4</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=pink&amp;color=pink&amp;scale=1" alt="pink"></td>
    </tr>
    <tr>
      <td>grey</td>
      <td>#555555</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=grey&amp;color=grey&amp;scale=1" alt="grey"></td>
    </tr>
    <tr>
      <td>silver</td>
      <td>#9f9f9f</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=silver&amp;color=silver&amp;scale=1" alt="silver"></td>
    </tr>
    <tr>
      <td>lightgrey</td>
      <td>#9f9f9f</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=lightgrey&amp;color=lightgrey&amp;scale=1" alt="lightgrey"></td>
    </tr>
    <tr>
      <td>black</td>
      <td>#000000</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=black&amp;color=black&amp;scale=1" alt="black"></td>
    </tr>
    <tr>
      <td>white</td>
      <td>#ffffff</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=white&amp;color=white&amp;scale=1" alt="white"></td>
    </tr>
    <tr>
      <td>critical</td>
      <td>#e05d44</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=critical&amp;color=critical&amp;scale=1" alt="critical"></td>
    </tr>
    <tr>
      <td>important</td>
      <td>#fe7d37</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=important&amp;color=important&amp;scale=1" alt="important"></td>
    </tr>
    <tr>
      <td>highlight</td>
      <td>#dbe300</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=highlight&amp;color=highlight&amp;scale=1" alt="highlight"></td>
    </tr>
    <tr>
      <td>ok</td>
      <td>#97CA00</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=ok&amp;color=ok&amp;scale=1" alt="ok"></td>
    </tr>
    <tr>
      <td>success</td>
      <td>#44cc11</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=success&amp;color=success&amp;scale=1" alt="success"></td>
    </tr>
    <tr>
      <td>informational</td>
      <td>#007ec6</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=informational&amp;color=informational&amp;scale=1" alt="informational"></td>
    </tr>
    <tr>
      <td>inactive</td>
      <td>#9f9f9f</td>
      <td><img src="https://api.jm26.net/badge?label=&amp;message=inactive&amp;color=inactive&amp;scale=1" alt="inactive"></td>
    </tr>
  </tbody>
</table>


</details>

### Icon

The Icon is the image on the left side of the badge.

To set the icon, use the `icon` parameter.

E.g. `https://api.jm26.net/badge?icon=f179`: ![f179](https://api.jm26.net/badge?label=&message=&scale=1&icon=f179)

#### Icon Codes

**Example Codes:**
- `f179` - GitHub
- `f1a0` - Google
- `f179` - Apple
- `f099` - Twitter

All icons are from [Font Awesome](https://fontawesome.com) and the codes can be found [here](https://fontawesome.com/v5/cheatsheet/free/brands).

## Advanced Usage

### Image Format

The Image Format is the format of the output image.

There are 3 supported formats: `png`, `jpg` and `gif`.

To set the image format, use the `format` parameter.

E.g. `https://api.jm26.net/badge?format=jpg`: ![jpg](https://api.jm26.net/badge?scale=1&format=jpg)

### Image Scale

The Image Scale is the scale of the output image.

The maximum scale is 100, numbers can be decimal (e.g. 1.5), but not smaller than 0.1.

To set the image scale, use the `scale` parameter.

E.g. `https://api.jm26.net/badge?scale=2.1`: ![scale=2](https://api.jm26.net/badge?scale=2.1)`https://api.jm26.net/badge?scale=0.5`: ![scale=0.5](https://api.jm26.net/badge?scale=0.5)

### Label Color

The Label Color is the background color of the left side of the badge (the label).

To set the label color, use the `labelcolor` parameter.

**Important:** The parameter names are CASE SENSITIVE (e.g. `labelcolor` is valid, but `labelColor` is not).

E.g. `https://api.jm26.net/badge?labelcolor=blue`: ![blue](https://api.jm26.net/badge/beta?scale=1&labelcolor=blue)

### Font Color

The Font Color is the color of the text on the badge (the label, icon and message).

To set the font color, use the `fontcolor` parameter.

**Important:** The parameter names are CASE SENSITIVE (e.g. `fontcolor` is valid, but `fontColor` is not).

E.g. `https://api.jm26.net/badge?fontcolor=blue`: ![blue](https://api.jm26.net/badge/beta?scale=1&fontcolor=blue) - There is currently a bug with the font color, so it is not working.

### Cache Lifetime

The Cache Lifetime is the time in seconds that the badge will be cached for.

To set the cache lifetime, use the `cache` parameter.

E.g. `https://api.jm26.net/badge?cache=3600`: ![cache=3600](https://api.jm26.net/badge?scale=1&cache=3600) - This badge will be cached for 1 hour.

### Status of PHP-Badges

The simple Status of the PHP-Badges instance is viewable by anyone and more detailed information is available with a valid password.

To view the simple status, use the `status` parameter.

E.g. `https://api.jm26.net/badge/beta?status`: ![status](https://api.jm26.net/badge/beta?scale=1&status)

To view the detailed status, use the `status` parameter with a valid password. The password is the same as the password for the maintenance mode and the default password is `password`. 
**PLEASE CHANGE THE PASSWORD! Here is a [guide](./configuration.html#maintenance-password) on how to change the password.**

E.g. `https://api.jm26.net/badge/beta?status=password` - The result will be a JSON object with the status information. Here is an example:

<details>
<summary>Click to view example</summary>
<code class="language-json">
{
  "status": "ok",
  "warnings": 0,
  "message": "Everything is working fine!",
  "version": {
    "current version": "1.2.2",
    "newest version": "1.2.0",
    "update available": false,
    "check for updates": true,
    "update url": "https://github.com/JMcrafter26/php-badges/releases/latest"
  },
  "server": {
    "server": "Apache",
    "php": "7.4.33",
    "directory": "/htdocs/badge",
    "file": "/htdocs/badge/generate.php",
    "host": "example.com",
    "ip": "1.1.1.1",
    "gd extension": "true"
  },
  "assets": {
    "font": "true",
    "icons": "true"
  },
  "external services": {
    "internet": "true",
    "github repo": "true",
    "update server": "true"
  },
  "configuration": {
    "maintenance mode": false,
    "icon": "&#xf09b;",
    "label": "Documentation:",
    "message": "go.jm26.net/badge-docs",
    "label color": "#555555",
    "message color": "#97CA00",
    "color text": "#ffffff",
    "auto font color": true,
    "image format": "png",
    "cachelife": 5,
    "scale": 15,
    "resize output": false,
    "font path": "./DejaVuSans.woff",
    "icons path": "./font-awesome.woff"
  }
}
<code>
</details>

#### Status Viewer

A simple status viewer *will* be available in the future at [test.jm26.net/badge-generator/status-viewer](https://test.jm26.net/badge-generator/status-viewer).

Screenshot of the status viewer:

![Screenshot](https://i.imgur.com/1jJ9M5t.png)

## Conclusion

That's it! You now know how to use PHP-Badges!

There are more features coming soon, so stay tuned!

If you haven't already configured your instance, you can do so [here](./configuration.html) - it is highly recommended that you do so, because the default configuration contains a password that is publicly available.

If you have any questions, or issues, feel free to open an issue on [GitHub](https://github.com/JMcrafter26/php-badges/issues) or contact me directly at [&#099;&#111;&#110;&#116;&#097;&#099;&#116;[&#097;&#116;]&#106;&#109;&#050;&#054;&#046;&#110;&#101;&#116;](mailto:&#099;&#111;&#110;&#116;&#097;&#099;&#116;[&#097;&#116;]&#106;&#109;&#050;&#054;&#046;&#110;&#101;&#116;)


***
<p style="text-align: center;">Made with ❤️ by <a href="https://jm26.net">JMcrafter26</a></p>
<p style="text-align: center; color: #aaa; font-size: 0.8em;">
Enjoying PHP-BADGES? Show some love by liking and sharing this repository or support me by <a href="https://www.buymeacoffee.com/JM26.NET" target="_blank">buying me a coffee ☕</a>

***

[GitHub](https://github.com/jmcrafter26/php-badges)
[Releases](https://github.com/jmcrafter26/php-badges/release/latest)
