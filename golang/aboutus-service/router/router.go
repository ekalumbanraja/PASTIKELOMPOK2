package router

import (
	"ABOUTUS-SERVICE/controllers"

	"github.com/gorilla/mux"
)

func InitializeRouter(aboutUsController *controllers.AboutUsController) *mux.Router {
	router := mux.NewRouter()
	router.HandleFunc("/aboutus", aboutUsController.CreateAboutUs).Methods("POST")
	router.HandleFunc("/aboutus", aboutUsController.GetAboutUs).Methods("GET")
	router.HandleFunc("/aboutus/{id}", aboutUsController.GetAboutUsByID).Methods("GET")
	router.HandleFunc("/aboutus/{id}", aboutUsController.UpdateAboutUs).Methods("PUT")
	router.HandleFunc("/aboutus/{id}", aboutUsController.DeleteAboutUs).Methods("DELETE")
	return router
}
