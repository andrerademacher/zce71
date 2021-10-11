if [ -x "$(command -v docker)" ]; then
    docker build -t t71 .
else
    echo "Docker needs to be installed"
    echo "https://www.docker.com/"

fi