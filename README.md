# SrPluginGenerator ILIAS Plugin

srag ILIAS plugin generator

This project is licensed under the GPL-3.0-only license

## Requirements

* ILIAS 6.0 - 7.999
* PHP >=7.2

## Installation

Start at your ILIAS root directory

```bash
mkdir -p Customizing/global/plugins/Services/UIComponent/UserInterfaceHook
cd Customizing/global/plugins/Services/UIComponent/UserInterfaceHook
git clone https://github.com/fluxfw/SrPluginGenerator.git SrPluginGenerator
```

Update, activate and config the plugin in the ILIAS Plugin Administration

## Description

Please ensure `composer` is installed on your server

Generates ILIAS base plugins and deliver as download as ZIP file

You can access plugin generator from the main menu entry or with the follow static url

```
https://your-domain/goto.php?target=uihk_srplugingenerator
```

Form:

![Form 1](./doc/images/form_1.png)
![Form 2](./doc/images/form_2.png)
