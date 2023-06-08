---
title: Get Started
layout: default
---


# Get started

We will guide you through the simple Installation process (not shire if this can be even called installation, because of how simple it is)

## Requirements

- PHP 5.4 or higher
- The GD extension installed (most PHP installations have this by default)
- (Optional: A cup of coffee ☕️)

**Alternatively** you could use my [publicly hosted version](https://api.jm26.net/badge) of PHP-BADGES, but I would recommend hosting it yourself, as it is very simple to do so.

## Installation Steps

1. Download the latest release from the [Releases](https://github.com/JMcrafter26/php-badges/releases/latest) page.
2. Extract the zip file and upload the `generate.php` from the `src` folder to your web server.
3. You're done! 🎉

## Whats next?


### Basic Usage

#### First Visit

When you first visit the `generate.php` file in your browser, the font will be automatically downloaded for you.

To create a badge, simply add open the `generate.php` file in your browser.
By default, the badge will be created with the following settings:
- Icon: GitHub 
- Label: Documentation
- Message: go.jm26.net/badge-docs
- Color: green

(Instructions for changing the default settings can be found [here](./usage.html#default-settings))

#### Creating a Badge

I recommend using the [Badge Generator](https://test.jm26.net/badge-generator/) to create your badges, as it is much easier to use.

**Otherwise** to generate a badge with different settings, simply add the following query parameters to the URL:

- `icon` - The icon to use, Font Awesome icon unicode (e.g. `f09b` for GitHub). See [Icons](./usage.html#icons) for more info.
- `label` - The label text (left side) of the badge
- `message` - The message text (right side) of the badge
- `color` - The color of the badge (e.g. `green`, `red`, ok, important, ff69b4, etc.)
- (optional) `url` - The URL to an external json file to get the badge settings from (see [External JSON](./usage.html#url) for more info)

#### Examples (quality was reduced due to the image being resized)

- Standard Badge

    ![Label Message](https://api.jm26.net/badge?g&label=Label&message=Message&color=blue&scale=2)

    `https://api.jm26.net/badge?g&label=Label&message=Message&color=blue`
- Badge with Icon

    ![Label Message](https://api.jm26.net/badge?g&label=Label&message=Message&color=important&icon=f09b&scale=2)

    `https://api.jm26.net/badge?g&label=Label&message=Message&color=important&icon=f09b`
- **BETA FEATURE!** 

    ![Stars](https://api.jm26.net/badge/beta?url=https://shields.io/github/stars/jmcrafter26/php-badges.json&color=FFDB2D&label=Stars&scale=2) 

    `https://api.jm26.net/badge/beta?url=https://shields.io/github/stars/jmcrafter26/php-badges.json&color=FFDB2D&label=Stars` (See [External JSON](./features#external-json) for more info)

    ### More Examples

    For more examples, please refer to the [Usage](./usage) page.

***
<p style="text-align: center;">Made with ❤️ by <a href="https://jm26.net">JMcrafter26</a></p>
<p style="text-align: center; color: #aaa; font-size: 0.8em;">
Enjoying PHP-BADGES? Show some love by liking and sharing this repository or support me by <a href="https://www.buymeacoffee.com/JM26.NET" target="_blank">buying me a coffee ☕</a>
</p>
<a href="https://github.com/jmcrafter26/php-badges" target="_blank"><img src="https://api.jm26.net/badge?g&label=Github&icon=f09b&message=Repository&color=007EC6" height="20px" alt="Github Repository" ></a>
<a href="https://github.com/jmcrafter26/php-badges/release/latest" target="_blank"><img src="https://api.jm26.net/badge?g&label=Github&icon=f09b&message=Releases&color=238636" height="20px" alt="Github Releases" ></a>
