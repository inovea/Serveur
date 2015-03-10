/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package physique;

/**
 *
 * @author Oussama
 */
public class FactoryPhysique {
    static ContainerServicesImpl containerSrv;
    static AlertServicesImpl alertSrv;
    static CircuitServicesImpl circuitSrv;
    static SteedServicesImpl steedSrv;
    
    public static ContainerServicesImpl getContainerSrv(){
        if(containerSrv == null){
            containerSrv = new ContainerServicesImpl();
        }
        return containerSrv;
    }
    
    public static AlertServicesImpl getAlertSrv(){
        if(alertSrv == null){
            alertSrv = new AlertServicesImpl();
        }
        return alertSrv;
    }
    
    public static CircuitServicesImpl getCircuitSrv(){
        if(circuitSrv == null){
            circuitSrv = new CircuitServicesImpl();
        }
        return circuitSrv;
    }
    
    public static SteedServicesImpl getSteedSrv(){
        if(steedSrv == null){
            steedSrv = new SteedServicesImpl();
        }
        return steedSrv;
    }
    
}
