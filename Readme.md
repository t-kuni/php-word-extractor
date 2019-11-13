1～10文字のNGramを作る
文字の出力回数をカウントする
単語の定義
・出現頻度が高い
・出現する文書の数／総文章数　が低い
全ての文章に出現
カウントの多い単語を

# About

This repository is project template for PHP CLI application.

# Usage

```
git clone --depth 1 ssh://git@github.com/t-kuni/php-cli-app-template [ProjectName]
cd [ProjectName]
rm -rf .git 
```

# Build

Build container.

```
docker-compose build app-debug
```

Install php libraries.

```
docker-compose run --rm app-debug composer install
```

Install node packages.  
Run follow command on host OS.

```
npm install
```

# Run app

```
docker-compose run --rm app-debug
```

# Start shell

```
docker-compose run --rm app-debug sh
```