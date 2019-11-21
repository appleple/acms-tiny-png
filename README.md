# TinyPNG for a-blog cms

## ダウンロード

[https://github.com/appleple/acms-tiny-png/raw/master/build/TinyPNG.zip](https://github.com/appleple/acms-tiny-png/raw/master/build/TinyPNG.zip)


## 実現できること

TinyPNGのAPIを利用して、画像のロスレス圧縮を実現できます。Hook機能を使って画像生成時に、すべてロスレス圧縮します。

また校正オプションを用意していて、ロスレス圧縮された状態で画像のリサイズをすることができます。

## 設定方法

[https://tinypng.com/](https://tinypng.com/) でアカウントを作成し、**API Key** を発行ください。発行した API Key を **private/config.system.yaml** に追記します。

```
tiny_png_api_key: xxxxxxxxxxxxxxxxxxxxxxxxxxx
```

## 校正オプション

```
resizeTinyPng(type, width, height)
```

### type の種類

- scale
- fit
- cover
- thumb 


```html
<img src="{path}[resizeTinyPng('scale', 600)]">
```
