// Minimální služba – projekt slouží jen k testu skeneru závislostí.
package main

import "github.com/gin-gonic/gin"

func main() {
	r := gin.Default()
	r.GET("/", func(c *gin.Context) {
		c.JSON(200, gin.H{"message": "Demo služba pro test Trivy Web Scanneru"})
	})
	r.Run(":8080")
}
