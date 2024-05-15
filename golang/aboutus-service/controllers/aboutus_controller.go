package controllers

import (
	"ABOUTUS-SERVICE/models"
	"ABOUTUS-SERVICE/services"
	"encoding/json"
	"net/http"
	"strconv"

	"github.com/gorilla/mux"
)

type AboutUsController struct {
	Service *services.AboutUsService
}

func NewAboutUsController(service *services.AboutUsService) *AboutUsController {
	return &AboutUsController{Service: service}
}

func (c *AboutUsController) CreateAboutUs(w http.ResponseWriter, r *http.Request) {
	var aboutus models.AboutUs
	json.NewDecoder(r.Body).Decode(&aboutus)
	err := c.Service.CreateAboutUs(&aboutus)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	w.WriteHeader(http.StatusCreated)
	json.NewEncoder(w).Encode(aboutus)
}

func (c *AboutUsController) GetAboutUs(w http.ResponseWriter, r *http.Request) {
	aboutus, err := c.Service.GetAboutUs()
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	json.NewEncoder(w).Encode(aboutus)
}

func (c *AboutUsController) GetAboutUsByID(w http.ResponseWriter, r *http.Request) {
	params := mux.Vars(r)
	id, _ := strconv.Atoi(params["id"])
	aboutus, err := c.Service.GetAboutUsByID(uint(id))
	if err != nil {
		http.Error(w, err.Error(), http.StatusNotFound)
		return
	}
	json.NewEncoder(w).Encode(aboutus)
}

func (c *AboutUsController) UpdateAboutUs(w http.ResponseWriter, r *http.Request) {
	params := mux.Vars(r)
	id, _ := strconv.Atoi(params["id"])
	var aboutus models.AboutUs
	json.NewDecoder(r.Body).Decode(&aboutus)
	aboutus.ID = uint(id)
	err := c.Service.UpdateAboutUs(&aboutus)
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	json.NewEncoder(w).Encode(aboutus)
}

func (c *AboutUsController) DeleteAboutUs(w http.ResponseWriter, r *http.Request) {
	params := mux.Vars(r)
	id, _ := strconv.Atoi(params["id"])
	err := c.Service.DeleteAboutUs(uint(id))
	if err != nil {
		http.Error(w, err.Error(), http.StatusInternalServerError)
		return
	}
	w.WriteHeader(http.StatusNoContent)
}
