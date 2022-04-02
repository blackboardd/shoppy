# [1.1.0](https://bitbucket.org/blackboardd/shoppy/compare/v1.0.0...v1.1.0) (2022-03-30)


### Bug Fixes

* **client\Dockerfile:** modified working directory of client from /app to /client ([1e4f974](https://bitbucket.org/blackboardd/shoppy/commits/1e4f974d652c8ddb2c39ad52373fa0f8f9318554))
* **Dockerfile:** Fixed issue with php8.1 and a dependency problem when working with klein ([7ff451d](https://bitbucket.org/blackboardd/shoppy/commits/7ff451df046959d323868934e15db5df00b46d59))
* **Docker:** modified docker and nginx to work with mysql database ([b6c8644](https://bitbucket.org/blackboardd/shoppy/commits/b6c86448f629e1fe167e651de3988e4476d6a340))
* **index.php:** utf8 => utf8mb4 ([42c352a](https://bitbucket.org/blackboardd/shoppy/commits/42c352a09b3a185e92168afed265a0b98376113f))
* **model\product\BookProduct:** weight property type changed from string to float ([8286992](https://bitbucket.org/blackboardd/shoppy/commits/82869926ef025da1e15f7fed64947d8a79ab76ec))
* **Model\Product:** changed dvdproduct to say disc instead ([1777714](https://bitbucket.org/blackboardd/shoppy/commits/17777142755601e309beeeb3b03fac69f650f84c))
* **Model\Product:** extra changes to make work with the database ([0f870df](https://bitbucket.org/blackboardd/shoppy/commits/0f870dfd7917ea8341fc769415bf3c24bd53bad6))
* **Model\Product:** modified model to work with mysql database ([a8836a6](https://bitbucket.org/blackboardd/shoppy/commits/a8836a6cba57796b15cd02b4800d473ea5ad48c0))
* **Shoppy\Model\Product:** implemented steps to sanitize sql input ([8e14ea7](https://bitbucket.org/blackboardd/shoppy/commits/8e14ea70f41f746ab1b9323f3d3e758daa3f09dd))
* **Shoppy\Server:** product_id using a temporary variable to supress errors ([0086fe4](https://bitbucket.org/blackboardd/shoppy/commits/0086fe4cc0a9e8a76fd0553c3fc35199ee735209))
* **tests:** added .keep file for tests ([453159d](https://bitbucket.org/blackboardd/shoppy/commits/453159d68554f5503dc832e40079d5794a76bce6))


### Features

* **composer:** integration with composer for dotenv package ([96b3017](https://bitbucket.org/blackboardd/shoppy/commits/96b3017a05e6c7194c2cc445d5fb681a5e3c657c))
* **Model/Product:** uml diagram for product ([a52e47c](https://bitbucket.org/blackboardd/shoppy/commits/a52e47cd742bd7315908b8b866f19582a9118934))
* **model\product\AbstractProduct:** created abstract product for usage with products ([51c5dda](https://bitbucket.org/blackboardd/shoppy/commits/51c5dda882ec63b8bcc3b8396660d8c0b063d8a1))
* **model\product\BookProduct:** book implementation of the abstract product class ([38e6a36](https://bitbucket.org/blackboardd/shoppy/commits/38e6a3698af97edc08c0eff0c6935538bd3cce1c))
* **model\product\DVDProduct:** dvd implementation of the abstract product class ([604470f](https://bitbucket.org/blackboardd/shoppy/commits/604470fcadc65f973cb956f3d426d336e3ba1d11))
* **model\product\FurnitureProduct:** furniture implementation of the abstract product class ([dae9d2e](https://bitbucket.org/blackboardd/shoppy/commits/dae9d2e93a0e1ce33eb6067017788e7122d4b5e1))
* **model\product\SymbolInterface:** interface for symbols for use with abstract product ([f998a01](https://bitbucket.org/blackboardd/shoppy/commits/f998a01382adfee1b63e501325e8bd67e74d4790))
* **Model:** implemented data mapper design pattern ([bd70a14](https://bitbucket.org/blackboardd/shoppy/commits/bd70a14c50acf0d12f5ea88a4f2c84e374a5b0c9))
* **Product\Model:** left pdf file in the commit ([35c7edc](https://bitbucket.org/blackboardd/shoppy/commits/35c7edc9bdca4f93eb361c827bda50aa17bf65f9))
* **Router:** integrated objects and procedural code needed to jumpstart router ([6dc8d3d](https://bitbucket.org/blackboardd/shoppy/commits/6dc8d3d6838b005d5aa0da4b4ac6973f17314daf))
* **Shoppy\Server:** added klein php router to project and finalized crud routes for the API ([647304c](https://bitbucket.org/blackboardd/shoppy/commits/647304cf9f0f2751c383a7cc831ea9c8db81b36f))

# 1.0.0 (2022-03-24)


### Bug Fixes

* **server:** modified docker container for server ([d7fcd75](https://bitbucket.org/blackboardd/shoppy/commits/d7fcd753a765f079ca19ffdd6db359c71517b38f))


### Features

* **app/index:** added sass ([5bc51f2](https://bitbucket.org/blackboardd/shoppy/commits/5bc51f2d3eac50dd39a5eb7a52fe14b2cf4b5602))
* **bootstrap:** added bootstrap to client ([cfd4824](https://bitbucket.org/blackboardd/shoppy/commits/cfd4824163eff1827286dbc35c6a0be28b085b64))
* **client/:** added typescript ([70b65dd](https://bitbucket.org/blackboardd/shoppy/commits/70b65dd6c13cbeeb2d732209db8b1d89ef9da1cb))
* **client:** added formatting and linting ([601d998](https://bitbucket.org/blackboardd/shoppy/commits/601d9987439ba257ff18c11c870be6414a573fe2))
* **client:** added style dictionary to client ([65f61b2](https://bitbucket.org/blackboardd/shoppy/commits/65f61b25017d114e26d7d8052c6a73c6256d1b4a))
* **init:** initial commit ([33965be](https://bitbucket.org/blackboardd/shoppy/commits/33965bea53c78a5727ca49ce7ea59b3dca9b199b))
* **storybook:** added storybook to client ([3f11282](https://bitbucket.org/blackboardd/shoppy/commits/3f11282e0587f0ffe9e399dc948f97d398404810))
* **style-dictionary:** added extra tokens, integrated into scss, used in app ([dc1a62b](https://bitbucket.org/blackboardd/shoppy/commits/dc1a62b6adee78fcc630e34dfed53e8a53310ede))
* **tokens:** modified style dictionary tokens to match design ([1355a9e](https://bitbucket.org/blackboardd/shoppy/commits/1355a9e72521690eb209b868df199109f8b5e17f))
