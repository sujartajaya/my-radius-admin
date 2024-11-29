# Build image
$ docker buildx build -t my-radius-image-01 -f Dockerfile .

# Run images
docker run --rm -d --name my-radius-01 -p 1812-1813:1812-1813/udp my-radius-image-01
