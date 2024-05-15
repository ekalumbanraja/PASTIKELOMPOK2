package controller

import (
	"net/http"
	"strconv"

	"github.com/ekalumbanraja/golang_gin_gorm_JWT/dto"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/entity"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/helper"
	"github.com/ekalumbanraja/golang_gin_gorm_JWT/service"
	"github.com/gin-gonic/gin"
)

type GalleryController interface {
	All(ctx *gin.Context)
	FindByID(ctx *gin.Context)
	Insert(ctx *gin.Context)
	Update(ctx *gin.Context)
	Delete(ctx *gin.Context)
}

type galleryController struct {
	GalleryService service.GalleryService
}

func NewGalleryController(GalleryService service.GalleryService) GalleryController {
	return &galleryController{
		GalleryService: GalleryService,
	}
}

func (c *galleryController) All(ctx *gin.Context) {
	var galleries []entity.Gallery = c.GalleryService.All()
	res := helper.BuildResponse(true, "OK!", galleries)
	ctx.JSON(http.StatusOK, res)
}

func (c *galleryController) FindByID(ctx *gin.Context) {
	id, err := strconv.Atoi(ctx.Param("id"))
	if err != nil {
		res := helper.BuildErrorResponse("Failed to get ID", "No param ID were found", helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	gallery := c.GalleryService.FindByID(uint(id))
	if (gallery == entity.Gallery{}) {
		res := helper.BuildErrorResponse("Data not found", "No data with given ID", helper.EmptyObj{})
		ctx.JSON(http.StatusNotFound, res)
	} else {
		res := helper.BuildResponse(true, "OK!", gallery)
		ctx.JSON(http.StatusOK, res)
	}
}

func (c *galleryController) Insert(ctx *gin.Context) {
	var galleryCreateDTO dto.GalleryCreateDTO
	errDTO := ctx.ShouldBind(&galleryCreateDTO)
	if errDTO != nil {
		res := helper.BuildErrorResponse("Failed to process request", errDTO.Error(), helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	result := c.GalleryService.Insert(galleryCreateDTO)
	response := helper.BuildResponse(true, "OK!", result)
	ctx.JSON(http.StatusCreated, response)
}

func (c *galleryController) Update(ctx *gin.Context) {
	var galleryUpdateDTO dto.GalleryUpdateDTO
	errDTO := ctx.ShouldBind(&galleryUpdateDTO)
	if errDTO != nil {
		res := helper.BuildErrorResponse("Failed to process request", errDTO.Error(), helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	id, errID := strconv.Atoi(ctx.Param("id"))
	if errID != nil {
		res := helper.BuildErrorResponse("Failed to get ID", "No param ID were found", helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	galleryUpdateDTO.ID = uint(id)
	result := c.GalleryService.Update(galleryUpdateDTO)
	response := helper.BuildResponse(true, "OK!", result)
	ctx.JSON(http.StatusOK, response)
}

func (c *galleryController) Delete(ctx *gin.Context) {
	var gallery entity.Gallery
	id, errID := strconv.Atoi(ctx.Param("id"))
	if errID != nil {
		res := helper.BuildErrorResponse("Failed to get ID", "No param ID were found", helper.EmptyObj{})
		ctx.JSON(http.StatusBadRequest, res)
		return
	}
	gallery.ID = uint(id)
	c.GalleryService.Delete(gallery)
	res := helper.BuildResponse(true, "Deleted", helper.EmptyObj{})
	ctx.JSON(http.StatusOK, res)
}
