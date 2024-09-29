from common.methods import set_progress
from infrastructure.models import Server

def generate_options_for_powerAction():
    return ["powerOn", "powerOff"]

def run(job, *args, **kwargs):
    vmName = "{{ vmName }}"
    powerAction = "{{ powerAction }}"
    try:
        server = Server.objects.get(hostname=vmName)
        if server:
            set_progress(f"Server {vmName} found")
            if powerAction == "powerOn":
                server.power_on()
                set_progress(f"Power on action performed on server {vmName}")
            elif powerAction == "powerOff":
                server.power_off()
                set_progress(f"Power off action performed on server {vmName}")
        else:
            set_progress(f"No server found with name {vmName}")
            return "FAILURE", f"No server found with name {vmName}", ""

        output_message = "The job ran successfully"
        return "SUCCESS", output_message, ""
    except Exception as err:
        error_message = str(err)
        set_progress(f"An error occurred: {error_message}")
        output_message = "The job failed"
        return "FAILURE", output_message, f"{error_message}"