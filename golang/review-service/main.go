package main

import (
	"REVIEW-SERVICE/config"
	"REVIEW-SERVICE/routes"
)

func main() {
	config.ConnectDatabase() // Menghubungkan ke database

	r := routes.SetupRouter() // Mengatur rute
	r.Run(":9008") // Menjalankan server di port 8080
}
