# __PLUGIN_NAME__ ILIAS Plugin

## Installation

Start at your ILIAS root directory. It is assumed the generated downloaded plugin `__PLUGIN_ID__.zip` is in your download folder `~/Downloads`. Otherwise please adjust the commands below

Run the follow commands:

```bash
mkdir -p Customizing/global/plugins
cd Customizing/global/plugins
mv ~/Downloads/__PLUGIN_ID__.zip __PLUGIN_ID__.zip
unzip __PLUGIN_ID__.zip
unlink __PLUGIN_ID__.zip
```

Update and activate the plugin in the ILIAS Plugin Administration

Look after `TODO`'s in the plugin code. May you can remove some files (For example config) depending on your use. Also override this initial Readme

## Requirements

* ILIAS __MIN_ILIAS_VERSION__ - __MAX_ILIAS_VERSION__
* PHP >=__MIN_PHP_VERSION__
