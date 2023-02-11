---
title: Home
layout: home
---

<!-- PHP-Badges Documentation introduction
Features 🌟

    Very simple 😌
    Many features 🤯
    Lightweight 💪
    Highly customizable 🎨
    Font Awesome icon support Font Awesome
    Create Badges using a simple Web GUI 📌
    Host it yourself! (Or use mine 🌐)
    No setup required, just upload and go 🚀
    More coming soon! 🔜
    All Feature and Usage Instructions listed here 📑

-->
# PHP-Badges

<img src="https://raw.githubusercontent.com/JMcrafter26/php-badges/main/.github/banner.jpg" alt="PHP-Badges Banner" style="width: 100%;">

A lightweight, highly customizable, and easy to use PHP Badge Generator, like shields.io, but focused on simplicity and ease of use for self-hosting.

## Features 🌟

- Very simple 😌
- Many features 🤯
- Lightweight 💪
- Highly customizable 🎨
- Font Awesome icon support Font Awesome <img height="20" src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/master/svgs/brands/font-awesome.svg?sanitize=true" alt="Font Awesome" style="vertical-align: middle;">
- Create Badges using a simple Web GUI 📌
- Host it yourself! (Or use mine 🌐)
- No setup required, just upload and go 🚀
- More coming soon! 🔜
- All Feature and Usage Instructions listed [here](/features) 📑
  
## Installation 📥

For more detailed instructions, see the [Get Started](/get-started) page.

### Requirements

- PHP 7.2 or higher
- PHP GD extension installed (most PHP installations have this by default)

### Installation Steps

1. Download the latest release from the [Releases](https://github.com/JMcrafter26/php-badges/releases/latest) page.
2. Extract the zip file and upload the `generate.php` from the `src` folder to your web server.
3. You're done! 🎉

## Usage 📖

For more detailed instructions, see the [Features and Usage](/features) page.

### Basic Usage

#### First Visit

When you first visit the `generate.php` file in your browser, the font will be automatically downloaded and cached for you.

To create a badge, simply add open the `generate.php` file in your browser.
By default, the badge will be created with the following settings:
- Icon: GitHub 
- Label: Documentation
- Message: go.jm26.net/badge-docs
- Color: green

(Instructions for changing the default settings can be found [here](/features#default-settings))

#### Creating a Badge

To generate a badge with different settings, simply add the following query parameters to the URL:

- `icon` - The icon to use, Font Awesome icon unicode (e.g. `f09b` for GitHub). See [Icons](/features#icons) for more info.
- `label` - The label text (left side) of the badge
- `message` - The message text (right side) of the badge
- `color` - The color of the badge (e.g. `green`, `red`, ok, important, ff69b4, etc.)
- (optional) `url` - The URL to an external json file to get the badge settings from (see [External JSON](/features#external-json) for more info)

#### Examples

- <img src="https://api.jm26.net/badge?g&label=Label&message=Message&color=blue" height="20px" alt="Label Message" style="display: inline-block; vertical-align: middle;"> `https://api.jm26.net/badge?g&label=Label&message=Message&color=blue`
- <img src="https://api.jm26.net/badge?g&label=Label&message=Message&color=important&icon=f09b" height="20px" alt="Label Message" style="display: inline-block; vertical-align: middle;"> `https://api.jm26.net/badge?g&label=Label&message=Message&color=important&icon=f09b`
- **BETA FEATURE!** <img src="https://api.jm26.net/badge/beta?url=https://shields.io/github/stars/jmcrafter26/php-badges.json&color=FFDB2D&label=Stars" height="20px" alt="Label Message" style="display: inline-block; vertical-align: middle;"> `https://api.jm26.net/badge/beta?url=https://shields.io/github/stars/jmcrafter26/php-badges.json&color=FFDB2D&label=Stars` (See [External JSON](/features#external-json) for more info)

***
<p style="text-align: center;">Made with ❤️ by <a href="https://jm26.net">JMcrafter26</a></p>
<p style="text-align: center; color: #aaa; font-size: 0.8em;">
Enjoying PHP-BADGES? Show some love by liking and sharing this repository or support me by <a href="https://www.buymeacoffee.com/JM26.NET" target="_blank">buying me a coffee ☕</a>!

<a href="https://github.com/JMcrafter26/php-badges" target="_blank" style="text-decoration: none; text-align: center;">
<img src="https://api.jm26.net/badge/beta?url=https://shields.io/github/stars/jmcrafter26/php-badges.json&color=FFDB2D&label=Stars" height="20px" alt="Label Message" style="display: inline-block;">
<img src="https://test.jm26.net/api/php-badges-views" height="20px" alt="PHP-Badges Views" style="display: inline-block;">
</a>
