// main.go

package main

import (
	"EMPLOYE-SERVICE/config"
	model "EMPLOYE-SERVICE/models"
	route "EMPLOYE-SERVICE/routes"
)

func main() {
    // Menghubungkan ke database
    config.ConnectDB()

    // Auto Migrate tabel
    config.DB.AutoMigrate(&model.Employee{})

    // Menyiapkan router
    r := route.SetupRouter()

    // Menjalankan server
    r.Run(":8080")
}
