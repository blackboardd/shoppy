FROM node:16.13.2-alpine
WORKDIR /app

COPY package.json ./
COPY package-lock.json ./
COPY . ./
RUN npm i
COPY . ./
CMD ["npm", "run", "start"]
