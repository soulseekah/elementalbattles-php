# EOSIO's Elemental Battles Frontend

A frontend to https://battles.eos.io/ contracts in pure PHP.

Uses the https://github.com/soulseekah/phpeosio library.

## Installing

```
composer install
```

## Running

Requires an HTTP node running on localhost:8888

Run with `php -S localhost:9000` :)

## Caution

**Use only with local tesnets!**

All signing is done on the server-side, meaning the key is passed to the server. This is insecure. Keys should be stored in localStorage, signing done on the client-side (browser eosio-js), preferably using browser wallets.

## Why?

Because Re(act|dux) is too damn complicated and fancy. Us backend programmers prefer beckend programming. And the less JavaScript the better :)

## TODO

- [x] Lesson 1
- [x] Lesson 2
- [ ] Lesson 3
- [ ] Lesson 4
- [ ] Lesson 5
- [ ] Lesson 6
- [ ] Lesson 7
- [ ] Lesson 8
