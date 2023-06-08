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

| Color Name | HEX Code | Preview |
| ---------- | -------- | ------- |
| red        | #e05d44  | ![red](https://api.jm26.net/badge?label=&message=red&color=red&scale=1) |
| orange     | #fe7d37  | ![orange](https://api.jm26.net/badge?label=&message=orange&color=orange&scale=1) |
| yellow     | #dfb317  | ![yellow](https://api.jm26.net/badge?label=&message=yellow&color=yellow&scale=1) |
| green      | #97CA00  | ![green](https://api.jm26.net/badge?label=&message=green&color=green&scale=1) |
| brighgreen | #44cc11  | ![brighgreen](https://api.jm26.net/badge?label=&message=brighgreen&color=brighgreen&scale=1) |
| cyan       | #00eaff  | ![cyan](https://api.jm26.net/badge?label=&message=cyan&color=cyan&scale=1) |
| blue       | #007ec6  | ![blue](https://api.jm26.net/badge?label=&message=blue&color=blue&scale=1) |
| violet     | #7b16ff  | ![violet](https://api.jm26.net/badge?label=&message=violet&color=violet&scale=1) |
| pink       | #ff69b4  | ![pink](https://api.jm26.net/badge?label=&message=pink&color=pink&scale=1) |
| grey       | #555555  | ![grey](https://api.jm26.net/badge?label=&message=grey&color=grey&scale=1) |
| silver     | #9f9f9f  | ![silver](https://api.jm26.net/badge?label=&message=silver&color=silver&scale=1) |
| lightgrey  | #9f9f9f  | ![lightgrey](https://api.jm26.net/badge?label=&message=lightgrey&color=lightgrey&scale=1) |
| black      | #000000  | ![black](https://api.jm26.net/badge?label=&message=black&color=black&scale=1) |
| white      | #ffffff  | ![white](https://api.jm26.net/badge?label=&message=white&color=white&scale=1) |
| critical   | #e05d44  | ![critical](https://api.jm26.net/badge?label=&message=critical&color=critical&scale=1) |
| important  | #fe7d37  | ![important](https://api.jm26.net/badge?label=&message=important&color=important&scale=1) |
| highlight  | #dbe300  | ![highlight](https://api.jm26.net/badge?label=&message=highlight&color=highlight&scale=1) |
| ok         | #97CA00  | ![ok](https://api.jm26.net/badge?label=&message=ok&color=ok&scale=1) |
| success    | #44cc11  | ![success](https://api.jm26.net/badge?label=&message=success&color=success&scale=1) |
| informational | #007ec6 | ![informational](https://api.jm26.net/badge?label=&message=informational&color=informational&scale=1) |
| inactive   | #9f9f9f  | ![inactive](https://api.jm26.net/badge?label=&message=inactive&color=inactive&scale=1) |

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
```json
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
```
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
