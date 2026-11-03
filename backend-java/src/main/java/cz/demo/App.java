package cz.demo;

import org.apache.logging.log4j.LogManager;
import org.apache.logging.log4j.Logger;

/** Minimální třída – projekt slouží jen k testu skeneru závislostí. */
public class App {
    private static final Logger LOG = LogManager.getLogger(App.class);

    public static void main(String[] args) {
        LOG.info("Demo backend pro test Trivy Web Scanneru");
    }
}
