#include <fstream>
#include <string>
#include <conio.h>
#include <iostream>
#include <windows.h>
#include <vector>
#include <sstream>
using namespace std;

char* Utf2ANSI(const char *srcCode)
{
    int srcCodeLen=0;   
    srcCodeLen=MultiByteToWideChar(CP_UTF8,NULL,srcCode,strlen(srcCode),NULL,0);   
    wchar_t* result_t=new wchar_t[srcCodeLen+1];   
    MultiByteToWideChar(CP_UTF8,NULL,srcCode,strlen(srcCode),result_t,srcCodeLen); 
    result_t[srcCodeLen]='\0';   
    srcCodeLen=WideCharToMultiByte(CP_ACP,NULL,result_t,wcslen(result_t),NULL,0,NULL,NULL);   
    char* result=new char[srcCodeLen+1];   
    WideCharToMultiByte(CP_ACP,NULL,result_t,wcslen(result_t),result,srcCodeLen,NULL,NULL);  
    result[srcCodeLen]='\0';   
    delete result_t;    
    return result;  
}

void insert2DB(string s){
    vector<string> v;
	v.assign(
	istream_iterator<string>(stringstream(s)),
	istream_iterator<string>()
	);
	for (auto v_it = v.begin(); v_it!=v.end(); ++v_it) cout << *v_it <<endl;
}

int main (){
 std::ifstream fin;
	 fin.open("source.s");
	 std:: string readIn;
	 unsigned int line=1;
     while (std::getline(fin,readIn)){
		 char * C_lineString = Utf2ANSI(readIn.c_str());
	     string lineString(C_lineString); 
		 insert2DB(lineString);
		// cout << lineString << endl;
	 }
	 getch();
     return 0;
}