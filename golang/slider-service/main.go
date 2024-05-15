package main

import (
	"SLIDER-SERVICE/config"
	"SLIDER-SERVICE/routes"
)

func main() {
    config.ConnectDatabase()

    r := routes.SetupRouter()
    r.Run(":9009")
}
