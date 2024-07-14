## Data Parsing Project

### What does this project parse?

This project is designed to parse data from various web sources. It includes parsing from the following sources:

1. **Yandex Weather**
   - URL: `https://yandex.ru/pogoda?lat=55.030199&lon=82.92043&lang=ru`
   - Parses weather information using Symfony HttpClient and Symfony DomCrawler.

2. **NGS.ru**
   - URL: `https://ngs.ru/text/`
   - Parses textual news using Symfony HttpClient and Symfony DomCrawler.

3. **RIA News**
   - URL: `https://ria.ru/world/`
   - Parses world news using Symfony HttpClient and Symfony DomCrawler.

4. **Slamjam**
   - URL: `https://it.slamjam.com/collections/sneakers?shpxid=e82f1c06-ba18-48f1-879b-debc29c41bde&pagination=5`
   - Parses sneaker information using Symfony HttpClient and Symfony DomCrawler.

### Installation and Setup

To work with this project, Docker must be installed on your machine. Follow these instructions to install and run the project:

1. **Start the nginx container:**
   ```bash
   docker-compose up nginx -d
   ```

2. **Apply database migrations:**
   ```bash
   docker-compose run artisan migrate
   ```

3. **Install Symfony HttpClient and Symfony DomCrawler:**
   ```bash
   docker-compose run composer require symfony/http-client symfony/dom-crawler
   ```

### Stopping the Project

To stop all containers and clean up resources, use the following command:

```bash
docker-compose down
```

### Additional Information

This project can be easily modified and extended to parse data from additional web sources. To add new parsers or modify existing functionality, refer to the Symfony HttpClient and Symfony DomCrawler documentation.

### License

This project is licensed under the [MIT License](#).